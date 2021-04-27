<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Редактировать запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="editDate">Дата записи</label>
                                <input type="date" class="form-control" id="editDate" name="date" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="editPhone">Телефон</label>
                                <input type="text" class="form-control" id="editPhone" name="phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editFirstName">Имя</label>
                        <input type="text" class="form-control" id="editFirstName" name="firstName">
                    </div>
                    <div class="form-group">
                        <label for="editSecondName">Фамилия</label>
                        <input type="text" class="form-control" id="editSecondName" name="secondName">
                    </div>
                    <div class="form-group">
                        <label for="editMiddleName">Отчество</label>
                        <input type="text" class="form-control" id="editMiddleName" name="middleName">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="eventId" value="">
                    <button id="deleteButton" type="button" class="btn btn-danger" data-dismiss="modal">Удалить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Запись</button>
                </div>
            </form>
        </div>
    </div>
</div>
