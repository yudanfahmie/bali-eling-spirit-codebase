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
  const delay = (ms) => new Promise((resolve) => window.setTimeout(resolve, ms));

  async function requestOnce(phase) {
    const controller = new AbortController();
    const timeout = window.setTimeout(() => controller.abort(), 120000);
    try {
      const response = await fetch(BESAuditEngine.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        signal: controller.signal,
        headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
        body: new URLSearchParams({
          action: 'bes_audit_run_phase', nonce: BESAuditEngine.nonce, phase,
          auditId, includeCode: includeCode.checked ? '1' : ''
        })
      });
      const text = await response.text();
      let json;
      try { json = JSON.parse(text); }
      catch (_) {
        const error = new Error(`Server returned an invalid response (${response.status}).`);
        error.retryable = [502, 503, 504].includes(response.status);
        throw error;
      }
      if (!response.ok || !json.success) {
        const error = new Error(json?.data?.message || `Request failed (${response.status}).`);
        error.retryable = [502, 503, 504].includes(response.status);
        throw error;
      }
      return json.data || {};
    } catch (error) {
      if (error.name === 'AbortError') {
        const timeoutError = new Error('This audit step exceeded 120 seconds and was stopped safely.');
        timeoutError.retryable = false;
        throw timeoutError;
      }
      throw error;
    } finally {
      window.clearTimeout(timeout);
    }
  }

  async function request(phase) {
    try { return await requestOnce(phase); }
    catch (error) {
      if (!error.retryable) throw error;
      status.textContent = 'Transient server error — retrying once…';
      await delay(700);
      return requestOnce(phase);
    }
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

  function renderDownload(data) {
    result.hidden = false;
    result.replaceChildren();
    const meta = document.createElement('div');
    const strong = document.createElement('strong');
    const small = document.createElement('small');
    const link = document.createElement('a');
    strong.textContent = data.filename || 'Audit bundle';
    small.textContent = includeCode.checked ? 'Migration-ready snapshot' : 'Structural-only snapshot';
    meta.append(strong, small);
    link.className = 'button button-primary';
    link.href = data.downloadUrl || '#';
    link.textContent = 'Download bundle';
    result.append(meta, link);
  }

  run.addEventListener('click', async () => {
    if (busy) return;
    busy = true; auditId = ''; run.disabled = true; result.hidden = true; result.replaceChildren();
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
          renderDownload(data);
        }
      }
    } catch (error) {
      status.textContent = `Audit stopped safely: ${error.message}`; status.className = 'is-error'; progress(0); await cleanup();
    } finally { busy = false; run.disabled = false; }
  });
})();
