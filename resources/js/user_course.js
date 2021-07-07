/*!
 *
 * @version 1.0.0
 */

import helper from './helper';

const objUserCourse = {};

$(function () {

    /**
     * Asigna los cursos al alumno
     */
    objUserCourse.save = function () {
        const button = $(this);
        helper.buttonLoading(button);
        const frm = $('#frmGeneral');
        axios.post(frm.attr('action'), frm.serialize()
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                location.href = helper.BASE_URL + 'home';
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

    $('#btnUserCourse').click(objUserCourse.save);

});
