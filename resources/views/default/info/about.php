<?php include TEMPLATE_DIR . '/header.php'; ?>
<main class="w-75">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a title="<?= lang('Home'); ?>" href="/"><?= lang('Home'); ?></a>
        </li>
        <li class="breadcrumb-item">
            <a title="<?= lang('Info'); ?>" href="/info"><?= lang('Info'); ?></a>
        </li>
    </ul>
    <h1><?= $data['h1']; ?></h1>
    
    Мы приветствуем минимализм и стараемся следовать этой концепции и на сайте.
    <br><br>
    Средний размер файла и «вес» веб-сайтов стали немного смешными. <br>
    В апреле 2016 года было отмечено, что средняя страница теперь <a rel="nofollow noreferrer" target="_blank" href="https://mobiforge.com/research-analysis/the-web-is-doom">больше, чем в игре DOOM.</a> 
    <br><br>
    Это не дело! 
    
    <h2>Минимальный javascript - не переворачивайте веб-пирамиду</h2>
    Существует концепция «пирамиды», которая использовалась много лет, когда люди говорят о строительстве для Интернета. Обычно он показывает прочную основу HTML, слой CSS, а вершиной пирамиды является javascript.
    <br><br>
    Однако современная веб-разработка фактически перевернула эту пирамиду с ног на голову. Для клиентского javascript стало стандартом доставлять и даже генерировать HTML и CSS. Многие базовые текстовые сайты (например, блоги) больше ничего не отображают без javascript.
    <br><br>
    Мы считаю, что полагаться на javascript на этом уровне - принципиально неправильный подход к сети, поэтому этот сайт построен «традиционным» способом. Javascript используется как можно меньше и в идеале только тогда, когда это единственный вариант для чего-то. И из-за этого...  
            
    <h3>Полностью функциональный для просмотра без javascript</h3>
    Данный сайт всегда будет работоспособен для просмотра без включенного javascript. Кто-то с отключенным javascript должен иметь возможность просматривать все списки на сайте, читать все типы сообщений и так далее.
    <br><br>
    Взаимодействие без javascript не будет приоритетом. Некоторые функции могут в конечном итоге не работать естественным образом из-за того, как они реализованы, но мы не будем беспокоиться о том, чтобы сделать такие вещи, как голосование, функциональными, когда javascript отключен.        
            
    <h3>Отсутствие голосов против</h3>
            
    Сайт не имеет отрицательных голосов ни за темы, ни за комментарии. 
    <br><br>
    Идеальное использование отрицательного голоса - это общий способ выразить «это не способствует», но на практике они чаще используются как «я не согласен» или «мне это не нравится». За качественные публикации часто голосуют против, потому что другие пользователи не согласны с этим мнением.
    <br> <br> 
    <i>Читать далее:</i> <a href="/info">Информация</a>
</main>
<?php include TEMPLATE_DIR . '/_block/info-page-menu.php'; ?>
<?php include TEMPLATE_DIR . '/footer.php'; ?> 