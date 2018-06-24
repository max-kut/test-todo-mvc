<style>
    .card-preview {
        position: fixed;
        right: -100%;
        top: 0;
        height: 100%;
        width: 400px;
        z-index: 100;
        transition: right .3s;
        background-color: #ffffff;
        box-shadow: 0 0 5px rgba(0, 0, 0, .4);
        text-align: center;
        overflow-y: auto;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .card-preview.show {
        right: 0;
    }
    .card-preview__content{
        position: relative;
        display: inline-block;
        max-height: 100%;
        text-align: left;
    }
</style>
<h1>Создать новую задачу</h1>
<div class="row">
    <div class="col">
        <form class="js-add-task-form">
            <div class="form-group">
                <label for="exampleFormControlInput0">Имя пользователя *</label>
                <input type="text"
                       name="name"
                       required
                       class="form-control js-input-model"
                       id="exampleFormControlInput0"
                       data-model-class="js-card-title"
                       placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Email пользователя *</label>
                <input type="email"
                       name="email"
                       required
                       class="form-control js-input-model"
                       id="exampleFormControlInput1"
                       data-model-class="js-card-subtitle"
                       placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Текст задачи *</label>
                <textarea class="form-control js-input-model"
                          name="text"
                          required
                          id="exampleFormControlTextarea1"
                          data-model-class="js-card-text"
                          rows="4"></textarea>
            </div>
            <input type="hidden" name="image_path" value="<?= $_SESSION['task_image'] ?: ''; ?>">
            <div class="btn-group" role="group">
                <button class="btn js-add-remove-img-btn <?= $_SESSION['task_image'] ? 'btn-danger' : 'btn-default'; ?>">
                    <?= $_SESSION['task_image'] ? 'Удалить изображение' : 'Добавить изображение'; ?>
                </button>
                <button class="btn btn-primary js-btn-preview">
                    Предварительный просмотр
                </button>
                <button type="submit"
                        class="btn btn-success">
                    Сохранить
                </button>
            </div>
        </form>
        <input type="file"
               class="js-input-img"
               style="display:none"
               accept="image/jpeg,image/png,image/gif">

    </div>
</div>

<div class="card-preview js-card-preview">
    <div class="card-preview__content">
        <div class=""></div>
        <div class="card" style="width: 320px;">
            <div class="card-img-top js-image-preview">
                <?php if ($_SESSION['task_image']): ?>
                    <img src="<?= $_SESSION['task_image']; ?>">
                <?php endif; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title js-card-title"></h5>
                <h6 class="card-subtitle mb-2 text-muted js-card-subtitle"></h6>
                <p class="card-text js-card-text"></p>
            </div>
        </div>
    </div>
</div>

