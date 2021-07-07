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
        var datos = new FormData(form[0]);
        axios.post(form.attr('action'),
            datos,
            {
                headers: {'Content-Type': 'multipart/form-data'},
            }
        ).then(({data}) => {
            $('#messages').before(helper.alertDisplay('success', data.message));
            setTimeout(function() {
                location.href = helper.BASE_URL + 'panel/admin/course/index/';
            }, 1000);
        }).catch((error) => {
            if (error.status === 422) {
                const errors = Object.entries(error.data.errors);
                helper.errorDisplay(errors);
            } else {
                $('#messages').before(helper.alertDisplay('danger', error.data.message));
            }
        }).finally(() => {
            helper.buttonCloseLoading(button);
        });
    };

    objCourseCreate.addDate = function() {
        const table = $('#tblCourseDates > tbody');
        const position = table.find('tr').length;
        table.append(objCourseCreate._addDate(position));
    };

    /**
     * @param position
     * @returns {string}
     * @private
     */
    objCourseCreate._addDate = function(position) {
        let row = '<tr data-position="' + position + '" >';
        row += '<td>';
        row += '<div class="form-group" >';
        row += '<input type="date" class="form-control" id="course_date_value[' + position + ']" name="course_date_value[' + position + ']" value="" />';
        row += '</div>';
        row += '</td>';
        row += '<td>';
        row += '<div class="form-group" >';
        row += '<input type="time" class="form-control" id="course_date_start[' + position + ']" name="course_date_start[' + position + ']" value="" />';
        row += '</div>';
        row += '</td>';
        row += '<td>';
        row += '<div class="form-group" >';
        row += '<input type="time" class="form-control" id="course_date_end[' + position + ']" name="course_date_end[' + position + ']" value="" />';
        row += '</div>';
        row += '</td>';
        row += '<td>';
        row += '<button type="button" role="button" class="btn btn-danger btn-sm option-course-hour-delete" >';
        row += '<i class="fa fa-trash" ></i> Eliminar';
        row += '</button>';
        row += '<input type="hidden" class="d-none" id="course_date_operation[' + position + ']" name="course_date_operation[' + position + ']" value="1" >';
        row += '</td>';
        row += '</tr>';
        return row;
    };

    /**
     * Elimina un item
     */
    objCourseCreate.deleteDate = function() {
        const button = $(this);
        const row = button.parents('tr');
        const position = row.data('position');
        if (document.getElementById('course_date_operation[' + position + ']')) {
            $(document.getElementById('course_date_operation[' + position + ']')).val(0);
        }
        row.hide();
    };

});

$(document).ready(function () {

    $('#btnSaveCourse').click(objCourseCreate.save);

    $('#btnAddCourseDate').click(objCourseCreate.addDate);

    $(document).on('click', '.option-course-hour-delete', objCourseCreate.deleteDate);

});
