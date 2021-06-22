export default {
    /**
     * @var {string}
     */
    BASE_URL: window.location.origin,
    /**
     * @param button
     */
    buttonLoading: (button) => {
        const icon = button.find('i.fa');
        if (icon.length) icon.hide();
        button.prepend('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" ></span>');
        button.prop('disabled', true);
    },
    /**
     * @param button
     */
    buttonCloseLoading: (button) => {
        const loading = button.find('span.spinner-border');
        const icon = button.find('i.fa');
        if (loading.length) loading.remove();
        if (icon.length) icon.show();
        button.prop('disabled', false);
    },
    /**
     * @param type
     * @param message
     * @param title
     * @returns {string}
     */
    alertDisplay: (type, message, title) => {
        const htmlTitle = (title) ? `<strong>${title}</strong>` : '';
        let htmlMessage = message;
        if (Array.isArray(message)) {
            htmlMessage = '<ul>';
            message.forEach((item) => {
                htmlMessage += `<li>${item}</li>`;
            });
            htmlMessage += '</ul>';
        }
        return `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${htmlTitle} ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        `;
    },
    /**
     * Muestra un cuadro de texto con el error en el elemento
     * @param el
     * @param message
     */
    elementErrorDisplay: (el, message) => {
        const $el = $(el);
        $el.addClass('is-invalid');
        $el.after(`
            <div class="invalid-feedback">
                ${message}
            </div>
        `);
    },
    /**
     * Recupera los errores para mostrar en pantalla
     * @param errors
     */
    errorDisplay: (errors) => {
        if (errors && Array.isArray(errors)) {
            errors.forEach((error) => {
                const $el = $('#' + error[0]);
                const feedback = $($el.parent()).find('.invalid-feedback');
                if (feedback) {
                    feedback.remove();
                }
                $el.addClass('is-invalid');
                $el.after(`
                    <div class="invalid-feedback">
                        ${error[1][0]}
                    </div>
                `);
                setTimeout(() => {
                    $el.removeClass('is-invalid');
                }, 10000);
            });
        }
    },
}
