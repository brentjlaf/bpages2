<?php
// views/dialogs/wNewfolder.php: Template placeholder for missing template coverage.
        // Loading direct helper to read skins data
        CI()->load->helper(['direct']);
        mwSkin()->loadSheet('', 'mw.windows');
        mwSkin()->loadSheet('', 'mw.forms');
?>
<style>
        .color-swatches {
                display: flex;
                gap: 12px;
                margin-top: 8px;
        }
        
        .color-swatch {
                width: 48px;
                height: 48px;
                border-radius: 8px;
                border: 2px solid transparent;
                cursor: pointer;
                position: relative;
                transition: all 0.2s ease;
                padding: 0;
        }
        

        .color-swatch.selected {
                border-color: rgba(0, 0, 0, 0.3);
        }
        
        .color-swatch span {
                position: absolute;
                inset: 0;
                border-radius: 6px;
        }
        
        .color-swatch::after {
                content: '✓';
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                color: #000;
                font-size: 20px;
                font-weight: bold;
                opacity: 0;
                transition: opacity 0.2s ease;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .color-swatch.selected::after {
                opacity: 1;
        }
        
        
</style>
<div class="winHeader">Create Folder</div>
<div class="winContainer" style="width: 100%;">
        <div class="winContent">
                <dl class="mwDialog">
                        <dt>Folder Name</dt>
                        <dd><input type="text" id="folderNameInput" name="folderName" required></dd>
                        <dt>Accent Color</dt>
                        <dd>
                                <div class="color-swatches">
                                        <button type="button" class="color-swatch selected" data-color="blue" aria-label="Blue" aria-pressed="true">
                                                <span aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="color-swatch" data-color="purple" aria-label="Purple" aria-pressed="false">
                                                <span aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="color-swatch" data-color="teal" aria-label="Teal" aria-pressed="false">
                                                <span aria-hidden="true"></span>
                                        </button>
                                        <button type="button" class="color-swatch" data-color="amber" aria-label="Amber" aria-pressed="false">
                                                <span aria-hidden="true"></span>
                                        </button>
                                </div>
                                <input type="hidden" id="folderColorInput" name="folderColor" value="blue">
                        </dd>
                </dl>
        </div>
</div>
<div class="winFooter">
        <a class="close winCloseClick">Cancel</a>
        <a class="apply" id="createFolderButton"></a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
        const colorSwatches = document.querySelectorAll('.color-swatch');
        const folderColorInput = document.getElementById('folderColorInput');
        
        colorSwatches.forEach(swatch => {
                swatch.addEventListener('click', function() {
                        // Remove selected class from all swatches
                        colorSwatches.forEach(s => {
                                s.classList.remove('selected');
                                s.setAttribute('aria-pressed', 'false');
                        });
                        
                        // Add selected class to clicked swatch
                        this.classList.add('selected');
                        this.setAttribute('aria-pressed', 'true');
                        
                        // Update hidden input value
                        folderColorInput.value = this.dataset.color;
                });
        });
});

</script>
