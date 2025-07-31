import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.openModal = function (id) {
    window.dispatchEvent(new CustomEvent('open-modal', { detail: { id } }))
}
