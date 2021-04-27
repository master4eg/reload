<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая запись</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createForm">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label for="date">Дата записи</label>
                                <input type="date" class="form-control" id="date" name="date" value="" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="phone">Телефон</label>
                                <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]{5,12}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstName">Имя</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" pattern="^[А-Яа-яЁё\s]+$" required>
                    </div>
                    <div class="form-group">
                        <label for="secondName">Фамилия</label>
                        <input type="text" class="form-control" id="secondName" name="secondName" pattern="^[А-Яа-яЁё\s]+$" required>
                    </div>
                    <div class="form-group">
                        <label for="middleName">Отчество</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" pattern="^[А-Яа-яЁё\s]+$" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Запись</button>
                </div>
            </form>
        </div>
    </div>
</div>
