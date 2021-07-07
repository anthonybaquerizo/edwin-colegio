/*!
 *
 * @version 1.0.0
 */

import helper from '../helper';

const objCourseAssistance = {};

$(function () {

    /**
     * Actualiza los datos del usuario
     */
    objCourseAssistance.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const frm = $('#frmGeneral');
        axios.post(frm.attr('action'), frm.serialize()
        ).then(() => {
            window.location = location.href;
        }).catch(({data}) => {
            $('#appHome').before(helper.alertDisplay('danger', data.message));
        }).finally(() => {
            helper.buttonCloseLoading(button);
        });
    };

});

$(document).ready(function () {

    $('#btnSaveAssistance').click(objCourseAssistance.save);

});
