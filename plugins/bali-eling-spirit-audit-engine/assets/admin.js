(() => {
  'use strict';
  const run = document.getElementById('bes-run-audit');
  const status = document.getElementById('bes-audit-status');
  const bar = document.getElementById('bes-progress-bar');
  const result = document.getElementById('bes-audit-result');
  const includeCode = document.getElementById('bes-include-code');
  if (!run || !window.BESAuditEngine) return;

  let auditId = '';
  let busy = false;
  const progress = (value) => { bar.style.width = `${Math.max(0, Math.min(100, value))}%`; };

  async function request(phase) {
    const response = await fetch(BESAuditEngine.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
      body: new URLSearchParams({
        action: 'bes_audit_run_phase', nonce: BESAuditEngine.nonce, phase,
        auditId, includeCode: includeCode.checked ? '1' : ''
      })
    });
    const json = await response.json();
    if (!response.ok || !json.success) throw new Error(json?.data?.message || `Request failed (${response.status})`);
    return json.data || {};
  }

  async function cleanup() {
    if (!auditId) return;
    try {
      await fetch(BESAuditEngine.ajaxUrl, {
        method: 'POST', credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
        body: new URLSearchParams({ action: 'bes_audit_cleanup', nonce: BESAuditEngine.nonce, auditId })
      });
    } catch (_) { /* best effort: never block developer flow */ }
  }

  run.addEventListener('click', async () => {
    if (busy) return;
    busy = true; auditId = ''; run.disabled = true; result.hidden = true; result.innerHTML = '';
    status.className = ''; progress(2);
    const phases = BESAuditEngine.phases || [];
    try {
      for (let i = 0; i < phases.length; i += 1) {
        const phase = phases[i];
        status.textContent = BESAuditEngine.labels?.[phase] || phase;
        progress(Math.max(4, Math.round((i / phases.length) * 94)));
        const data = await request(phase);
        auditId = data.auditId || auditId;
        if (phase === 'finalize') {
          progress(100); status.textContent = 'Audit ready.'; status.className = 'is-done';
          result.hidden = false;
          result.innerHTML = `<div><strong>${data.filename || 'Audit bundle'}</strong><small>${includeCode.checked ? 'Migration-ready snapshot' : 'Structural-only snapshot'}</small></div><a class="button button-primary" href="${data.downloadUrl}">Download bundle</a>`;
        }
      }
    } catch (error) {
      status.textContent = `Audit stopped safely: ${error.message}`; status.className = 'is-error'; progress(0); await cleanup();
    } finally { busy = false; run.disabled = false; }
  });
})();
