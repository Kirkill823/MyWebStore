<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel = "stylesheet" href = "{$templateWebPath}css/main.css">
        <title>{$pageTitle}</title>

    </head>
    <body>
        {include file = "../includes/header.tpl"}
        <div class = "wrapper">
            {include file = "../includes/sidebarMenu.tpl"}
            <div id = "content">
                <h5>Последние поступления</h5>
                {include file = '../includes/productCards.tpl'}
            </div>
        </div
        {include file = "../includes/footer.tpl"}
    </body>
    <script src = "{$templateWebPath}js/assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src = "/js/jquery-3.6.0.min.js" type = "text/javascript"></script>
    <script src = "/js/main.js" type = "text/javascript"></script>
</html>

