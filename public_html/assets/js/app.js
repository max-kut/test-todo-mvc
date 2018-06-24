(function ($) {

    /**
     * Авторизация в приложении
     */
    (function () {
        let authUser = {};

        $('.js-login-form').on('submit', function (e) {
            e.preventDefault();
            const th = $(this);
            $.ajax({
                url: '/login',
                method: 'POST',
                dataType: 'json',
                data: th.serialize()
            }).done(response => {
                authUser = Object.assign({}, response);
                th.closest('.dropdown').dropdown('toggle');
                $(document).trigger('login');
            }).fail(err => {
                let $alert = $('.alert', th);
                $alert.text(err.responseJSON.message).slideDown();
                setTimeout(() => {
                    $alert.slideUp();
                }, 5000)
            });
        });

        // хак бутстрап компонента, который останавливает нативные клики по ссылкам
        $(document).on('mousedown', '.js-logout', function (e) {
            e.preventDefault();
            window.location = '/logout';
        });

        // хук входа на сайт
        $(document).on('login', function (e) {
            $('.js-login-true').prop('hidden', false);
            $('.js-login-false').prop('hidden', true);
            $('.js-auth-user-name').text(authUser.name);
            if (authUser.is_admin) {
                $('.js-close-task').prop('hidden', false);
                $('.js-edit-text-task').prop('hidden', false);
            }
        });
    })();


    /**
     * Создание задачи
     */
    (function () {
        const $addRemoveImgBtn = $('.js-add-remove-img-btn');
        const $inputImagePath = $('input[name="image_path"]');

        $addRemoveImgBtn.on('click', function (e) {
            e.preventDefault();
            const th = $(this);
            if (th.hasClass('btn-default')) {
                $('.js-input-img').trigger('click');
            } else {
                if (!confirm("Удалить изображение?")) return false;

                const src = $inputImagePath.val();

                $.ajax({
                    url: '/remove-image',
                    method: 'POST',
                    data: {src: src}
                }).done(response => {
                    console.log(response);
                    $('.js-image-preview').html('');

                    th.toggleClass('btn-default btn-danger')
                        .text('Добавить изображение');
                })
            }
        });

        /**
         * AJAX загрузка изображения
         */
        $('.js-input-img').on('change', function (e) {
            e.preventDefault();
            const data = new FormData();
            $.each(e.target.files, function (key, value) {
                data.append(key, value);
            });

            $.ajax({
                url: '/load-image',
                method: 'POST',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
            }).done(response => {

                $inputImagePath.val(response);
                $('.js-image-preview').html(
                    `<img src="${response}" />`
                );

                $addRemoveImgBtn.toggleClass('btn-default btn-danger')
                    .text('Удалить изображение');
            });
        });

        // Кнопка предварительного просмотра
        $('.js-btn-preview').on('click', function (e) {
            e.preventDefault();
            $('.js-card-preview').toggleClass('show');
        });

        // связывание данных
        // jQuery не Vue, поэтому такие костыли
        $('.js-input-model').on('input', function () {
            const th = $(this);
            $('.' + th.data('model-class')).html(th.val())
        });

        $('.js-add-task-form').on('submit', function (e) {
            e.preventDefault();
            const th = $(this);
            $('[type="submit"]',th)
                .text('Сохранение...')
                .prop('disabled', true);
            $.ajax({
                method: 'POST',
                data: th.serialize(),
            }).done(response => {
                // перекинем на главную
                window.location = "/"
            })
        })

    })();


    /**
     * Редактирование задачи
     */
    (function () {
        /**
         * Обработчик закрытия задачи
         */
        $(document).on('click', '.js-close-task', function (e) {
            e.preventDefault();
            if (!confirm("Закрыть задачу?")) return false;
            const th = $(this);
            const $card = th.closest('.js-card');
            const taskId = $card.data('id');

            th.prop('disabled', true);

            $.ajax({
                url: '/close-task',
                method: 'POST',
                dataType: 'json',
                data: {id: taskId}
            }).done(response => {
                $card.addClass('card--closed');
                th.prop('hidden', true);
            }).fail(err => {
                alert(err.responseJSON.message)
            })
        });

        /**
         * Обработчик редактирования/сохранения записи
         */
        $(document).on('click', '.js-edit-text-task', function (e) {
            e.preventDefault();
            const th = $(this);
            const $card = th.closest('.js-card');
            const $cardText = $('.js-card-text', $card);
            const oldText = $cardText.html();

            if (!th.hasClass('editing')) {
                /**
                 * Режим редактирования
                 */
                // покажем форму редактирования
                $cardText.after(
                    $('<textarea class="js-editing">')
                        .val(oldText)
                        .css({
                            width: "100%",
                            minHeight: (15 + $cardText.height()) + 'px'
                        })
                );
                // скроем блок с текстом
                $cardText.prop('hidden', true);
                th.text('Сохранить')
            } else {
                /**
                 * режим сохранения
                 */

                const $inpText = $('.js-editing', $card);
                const newText = $inpText.val();

                // обновляем в случае изменений
                if (oldText !== newText) {
                    $cardText.html(newText);
                    $.ajax({
                        url: '/edit-task',
                        dataType: 'json',
                        method: 'POST',
                        data: {
                            id: $card.data('id'),
                            text: newText
                        }
                    }).fail(err => {
                        alert(err.responseJSON.message)
                    })
                }
                $cardText.prop('hidden', false);
                $inpText.remove();
                th.text('Редактировать')
            }
            th.toggleClass('editing');
        });

    })();

})(jQuery);