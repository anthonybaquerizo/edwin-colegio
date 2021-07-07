/*!
 *
 * @version 1.0.0
 */

import helper from './../helper';

const objResource = {};

$(function () {

    /**
     * Realiza la creación del usuario
     */
    objResource.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const form = $('#frmGeneral');
        var datos = new FormData(form[0]);
        axios.post(form.attr('action'),
            datos,
            {
                headers: {'Content-Type': 'multipart/form-data'},
            }
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                window.location = location.href;
            }, 1000);
        }).catch(({data}) => {
            const errors = Object.entries(data.errors);
            helper.errorDisplay(errors);
        }).finally(() => {
            helper.buttonCloseLoading(button);
        });
    };

});

$(document).ready(function () {

    $('#btnSaveResource').click(objResource.save);

});
