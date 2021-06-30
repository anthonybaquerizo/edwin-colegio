/*!
 *
 * @version 1.0.0
 */

import helper from './../../helper';

const objUserEdit = {};

$(function () {

    /**
     * Realiza la creación del usuario
     */
    objUserEdit.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const formData = new FormData();
        const file = $('#photo')[0].files[0];
        formData.append('file', file);
        formData.append('txt_dni', $('#txt_dni').val());
        formData.append('txt_lastname', $('#txt_lastname').val());
        formData.append('txt_names', $('#txt_names').val());
        formData.append('txt_email', $('#txt_email').val());
        formData.append('txt_phone', $('#txt_phone').val());
        formData.append('cbo_gender', $('#cbo_gender').val());
        formData.append('txt_username', $('#txt_username').val());
        formData.append('txt_password', $('#txt_password').val());
        axios.post('panel/admin/user/update/' + $('#user_id').val(),
            formData,
            {
                headers: {'Content-Type': 'multipart/form-data'},
            }
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                location.href = helper.BASE_URL + 'panel/admin/user/index/' + $('#txt_type').val();
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

    $('#btnSaveEdit').click(objUserEdit.save);

});
