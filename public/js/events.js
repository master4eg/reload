document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        editable: true,
        initialView: 'dayGridMonth',
        events: {url: '/api/events/showInterval', method: 'POST'},
        dateClick: function (info) {
            $('#date').val(info.dateStr);
            $('#modal').modal('show');
        },
        eventClick: function (info) {

            var id = info.event.id;

            $.ajax({
                url: 'api/events/' + id + '/edit',
                type: 'GET',
                cache: false,
                dataType: 'json',
                success: function (response) {
                    response = response[0];
                    // $('input#editDate').val(info.dateStr); лучше дату брать с респонса,
                    // на случай, если кто-то уже поменял
                    $('#editDate').val(response.date);
                    $('#editPhone').val(response.phone);
                    $('#editFirstName').val(response.firstName);
                    $('#editSecondName').val(response.secondName);
                    $('#editMiddleName').val(response.middleName);
                    $('#eventId').val(id);
                    $('#editModal').modal('show');
                }
            });
        },
        eventDrop: function (info) {
            var id = info.event.id;
            var date = info.event.startStr;
            $.ajax({
                url: 'api/events/' + id,
                type: 'PUT',
                dataType: 'json',
                data: {date: date},
                success: function (response) {
                    if (response.status === 'error') {
                        info.revert();
                        error(response.message);
                    }
                }
            });
        },
        eventContent: function (info) {
            var fName = info.event.extendedProps.firstName;
            var sName = info.event.extendedProps.secondName;
            var mName = info.event.extendedProps.middleName;
            var fullName = fName + ' ' + sName.charAt(0) + '. ' + mName.charAt(0) + '.';

            return {html: fullName + '<br>' + info.event.extendedProps.phone}
        }
    });

    calendar.setOption('locale', 'ru');
    calendar.setOption('firstDay', 1);
    calendar.render();

    $('#createForm').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'api/events',
            type: 'POST',
            cache: false,
            dataType: 'json',
            data: data,
            success: function (response) {
                calendar.addEvent({
                    'id': response.id,
                    'date': response.date,
                    'phone': response.phone,
                    'firstName': response.firstName,
                    'secondName': response.secondName,
                    'middleName': response.middleName
                });
                $('#modal').modal('hide');
            },
            error: function (response) {
                if (response.status === 422) {
                    var err = $.parseJSON(response.responseText);
                    var message = '';
                    $.each(err.errors, function (key, value) {
                        message += '<b>' + key + '</b>: ' + value + '<br>';
                    });
                    $('#modal').modal('hide');
                    error(message);
                }
            }
        });
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var id = $('#eventId').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'api/events/' + id,
            type: 'PUT',
            cache: false,
            dataType: 'json',
            data: data,
            success: function (response) {
                if (response.status === 'ok') {
                    response = response[0];
                    deleteEvent(id);
                    calendar.addEvent({
                        'id': id,
                        'date': response.date,
                        'phone': response.phone,
                        'firstName': response.firstName,
                        'secondName': response.secondName,
                        'middleName': response.middleName
                    });
                } else {
                    error('Неизвестная ошибка при обновлении записи');
                }

                $('#editModal').modal('hide');
            },
            error: function (response) {
                if (response.status === 422) {
                    var err = $.parseJSON(response.responseText);
                    var message = '';
                    $.each(err.errors, function (key, value) {
                        message += '<b>' + key + '</b>: ' + value + '<br>';
                    });
                    $('#editModal').modal('hide');
                    error(message);
                }
            }
        });
    });

    $('#deleteButton').on('click', function () {
        var id = $('#eventId').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'api/events/' + id,
            type: 'DELETE',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'ok') {
                    deleteEvent(id);
                } else {
                    error('Ошибка удаления записи, возможно запись уже удалена.')
                }
            }
        });
    });

    function error(text) {
        $('#errorModalBody').html(text);
        $('#errorModal').modal('show');
    }

    function deleteEvent(id) {
        var event = calendar.getEventById(id);
        event.remove();
    }
});
