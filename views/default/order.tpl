<!doctype html>
<html lang="en">
<head>
    {include file = "../includes/head.tpl"}
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=JlGmlY-d9jynGtKmfVbFX_ttDW4oOsue4gmuZWuho69OhB947UujVcd3EARGwqkMN2TTzYvKbatAH74U2iLaUAbyQg99vvkTbxcVQANB4_jeiKYihJ6BLONgP_dHKQNBTtfenvWVu-xvIt_z1DI9Z1bdnmzll-yi-JxQeS5KTBgJIldDJc6jMg7s8-pToUCKGk3bReK57gzk_dAz4QsNu4j67NzCpsuKIgS0ITuY49Pv2HtG-0qHKOFhyNfOAfh3RJTcFdh8WHz26hoUnxWmXi62Rg8dTqhiLGIirizrFPr3wCudVkkjCruMhAnzwFjEHZKMf90W0dvsbn9FrzZiAgM-V1ZxufI3Z6Un14uVOukY8IagXD_iH0Nebnp1ZqsfRBazPjM5GluIx-wQcA2NgS_ucF09_GiEiaQR-GzkS4inCznDrtiLEZKBpapi3deU4nlGj7Llele2n_IaB9AIovw7TZlS1VwIQCkgAtjBxzfqd5VG-34zvgDDYyu99NLwc0_uEYMac-RKItLFNrPU2MstCnNhl-7WjoAzr1GWI7e6KSLfy0hjG0lzics6pgJxHfmPKJq-gPzhIbpKk0L_7HhRB4M25h-3HjVpvUwtMCPyeQGclib5VZaWpwHqWKnF_122_qINTw9pe9XXmPl0H-sVhFeZuUd6zGcMc86DojKhN1cDrcA4Fo6f9YGKBt_BFUk7_CNY4oDn16naiy7tj82lxnXJR8ULbHbnx5Gb7wZ_L_1xw_vBnFIoYryJCDAAnenrTMTxXw8SprJbTWBaMPm_8HZmZzfEtIE8HVYqtFuVX-V8ZLphCxaoMprXn6PiBzrzYMsUxHSOIftxgDKyfg3CN7kXW1OsAktLzgW_71YtMa9-Cnj2vTO4Sj9L3CvAXXZ7d5hSaCLzARbGUHErzF7sEkmdkcYvPo3gjp7JeJDIxiBJjIAet9xJQcrxWvtPFH6hGmHP4HCXjItNIJAFL35beKfnIQyrSFMqRJWp6UZIyZlDgQ54Q5qkrdB4bwLD_OzH5TzKgpNkrTWyD65zeTgyZbOMrjEi1mVxnB8AGOMpNQWKswg1UMwz7qxmXCfc" charset="UTF-8"></script>
</head>
<body>
    {include file = "../includes/header.tpl"}
    <div class = "wrapper">
        {include file = "../includes/sidebarMenu.tpl"}
        <div id="content">
            <h5>Ваш заказ</h5>
            <form id = "formOrder" action = "/?controller=cart&action=saveOrder" method = "POST">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        {foreach $recProducts as $item name=products}
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4" style = "font-size: 13px;">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2">
                                            <img src="img/products/{$item['image']}.jpg" class="img-fluid rounded-3" alt="{$item['name_ru']}">
                                        </div>
                                        <label name="{$item['name_ru']}" class="col-md-4 col-lg-4 col-xl-4" style="color: black">{$item['name_ru']}</label>
                                        <div class="col-md-3 d-flex">
                                            <label name="itemCnt_{$item['id']}" id="itemCnt_{$item['id']}">Количество: {$item['cnt']}</label>
                                        </div>
                                        <div class="col-md-2">
                                            <h9 id="itemRealPrice_{$item['id']}" class="mb-0">{$item['realPrice']} руб.</h9>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/foreach}
                        <h6>Данные получателя: </h6>
                        <div class="col-md-6 border-right">
                            <div class="p-2 py-1">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email: </label><label id = "userEmail" class="labels"> {$arrUser['email']}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Имя: </label><label id = "userName"  class="labels"> {$arrUser['name']}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Телефон: </label><label id = "userPhone"  class="labels"> {$arrUser['phone']}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Адрес доставки: </label><label id = "userAddress" class="labels"> {$arrUser['address']}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-pills order">
                            <li class="nav-item">
                                <button class="btn btn-primary btn-sm" type="button" onclick="saveOrder();">Оформить заказ</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {include file = "../includes/footer.tpl"}

</body>
<script src="{$templateWebPath}js/assets/dist/js/bootstrap.bundle.min.js" ></script>
</html>

