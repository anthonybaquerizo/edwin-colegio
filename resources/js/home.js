/*!
 *
 * @version 1.0.0
 */

import helper from './helper';

const objHome = {};

$(function () {

    /**
     * Actualiza los datos del usuario
     */
    objHome.update = function () {
        const button = $(this);
        helper.buttonLoading(button);
        axios.put('panel/user/update', {
            txt_dni: $('#txt_dni').val(),
            txt_lastname: $('#txt_lastname').val(),
            txt_names: $('#txt_names').val(),
            txt_email: $('#txt_email').val(),
            txt_phone: $('#txt_phone').val(),
            cbo_gender: $('#cbo_gender').val(),
            txt_password: $('#txt_password').val(),
        }).then(({data}) => {
            console.log(data);
            $('#appHome').before(helper.alertDisplay('success', data.message));
        }).catch(({data}) => {
            const errors = Object.entries(data.errors);
            helper.errorDisplay(errors);
        }).finally(() => {
            helper.buttonCloseLoading(button);
        });
    };

    /**
     * Cambio de foto del usuario
     */
    objHome.changePhoto = function () {
        const formData = new FormData();
        const file = $(this)[0].files[0];
        formData.append('file', file);
        axios.post('panel/user/change_photo',
            formData,
            {
                headers: {'Content-Type': 'multipart/form-data'},
            },
        ).then(() => {
            window.location = location.href;
        }).catch(({ data }) => {
            $('#appHome').before(helper.alertDisplay('danger', data.message));
        }).finally(() => {
            this.value = '';
        });
    };

});

$(document).ready(function () {

    $('#btnUpdate').click(objHome.update);

    $('#change_photo').change(objHome.changePhoto);

});
