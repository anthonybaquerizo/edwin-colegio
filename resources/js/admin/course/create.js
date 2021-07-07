/*!
 *
 * @version 1.0.0
 */

import helper from './../../helper';

const objCourseCreate = {};

$(function () {

    /**
     * Realiza la creación del usuario
     */
    objCourseCreate.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const form = $('#frmGeneral');
        axios.post(form.attr('action'),
            form.serialize()
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                location.href = helper.BASE_URL + 'panel/admin/course/index/';
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

    $('#btnSaveCourse').click(objCourseCreate.save);

});
