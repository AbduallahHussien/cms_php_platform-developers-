<style>
    .voice-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(2px);
    }

    .voice-dialog {
        width: 360px;
        max-width: 92vw;
        background: #111;
        color: #eee;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        overflow: hidden;
        font-family: system-ui, sans-serif;
    }

    .voice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #222;
        font-weight: 600;
    }

    .voice-body {
        padding: 16px;
    }

    .voice-status {
        display: flex;
        gap: 10px;
        align-items: baseline;
        margin-bottom: 12px;
    }

    #voice-timer {
        font-variant-numeric: tabular-nums;
        font-weight: 700;
    }

    .voice-error {
        color: #ff6b6b;
        margin-top: 8px;
    }

    .voice-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
        padding: 12px 16px;
        border-top: 1px solid #222;
    }

    .voice-actions button {
        padding: 8px 12px;
        border-radius: 8px;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .voice-actions .primary {
        background: #23c55e;
        color: #111;
    }

    .voice-actions .secondary {
        background: #222;
        color: #eee;
        border-color: #333;
    }

    .voice-actions .danger {
        background: #ef4444;
        color: #111;
    }

    .voice-close {
        background: transparent;
        border: none;
        color: #aaa;
        font-size: 16px;
        cursor: pointer;
    }
</style>
<div id="voice-modal" class="voice-modal" style="display:none;">
    <div class="voice-dialog">
        <div class="voice-header">
            <span>Voice message</span>
            <button class="voice-close" aria-label="Close">✕</button>
        </div>

        <div class="voice-body">
            <div class="voice-status">
                <span id="voice-timer">00:00</span>
                <span id="voice-hint">Recording…</span>
            </div>

            {{-- <audio id="voice-preview" class="w-100" controls style="display:none;"></audio> --}}

            <div id="voice-error" class="voice-error" style="display:none;"></div>
        </div>

        <div class="voice-actions">
            {{-- <button id="voice-stop" class="danger">Stop</button> --}}
            {{-- <button id="voice-restart" class="secondary" style="display:none;">Re-record</button> --}}
            <button id="voice-send" class="primary">Send</button>
            <button id="voice-cancel" class="secondary">Cancel</button>
        </div>
    </div>
</div>