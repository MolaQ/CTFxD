$(document).ready(function () {
    window.livewire.on('alert_remove', () => {
        setTimeout(function () {
            $(".alert-success").fadeOut('fast');
        }, 3000); // 3 secs
    });
});