<!doctype html>
    <html lang="en">
    <head>
        {include file = "../includes/head.tpl"}
    <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=-OfxywCrrnChnLc5NKOehPd3JyWhX7wL1sPoWM_5INePA8KGw_yzPmkHuHS7zOzTfLaNamA7_4t5f_OLyGc4SmxasAADe6qjtic5G3IWimWoWBn5o1UGGgd1IXclZSN4mai5x0w160B_8os7H65POkTBI-yr3YrXkkv-CrRRqRVlz_ZH1WWIdNQTEI3FFkD9Eiq9TnkuXWoJ8q7tklsKeUUFm21HPuRNI4lbIAceUubMY-REH2LYRCWfQqGwDoSPKTYCgL2_OOxv69H2vfeTJZlSYlSvQGaRD5lEmNnYdou4gUHBD5IZS1SL5ywudBbARYDSKNfDMW2eSStu8zU0BdvzRwEtzkRc6AXqYPxpqV_FFv1w8-lsRGxZOb-7J8ZNRR-lOqwu3DwF283X6gM-zvXq3Th6H0vT5xklMUXtk-d5oipUf-zxbxB2ddDxUzezLAU8EsfpUI5a_bYosiuP3HoqP2Wa8BW_tZXAfpMmoT4ecZdzH8K77JAm4K5IYkLAs2vx5wJv30Crr3XZx9NjUW69Y5iEoH5HCxePDDBwE9eLauyAzMOU6k_1T-Z5o8EQknqFieDACAC92jz3HiUem0mm1Xvdc0Okb-6Ahrn_U1lqYa_RjvPt7iVRmq6bmUCiAVQIDOrSrIlAtaDf_PYhgCJAxrVQ3KVcBZWRoF14OepvClZUmP5Jrb-GHRp72WPtWFc_nIp_YUtigb3HFXoLvuHoAIM-uuOOt8G0c-jtQGZEs4riIzKjhQZVKkiOI05CWoF1Ym35InUak9KLUV_lgP5B7g7E1dJ6T6qq4M5mMWa-UjRgeRFgGfyBEx0hWgQh-RwePvjXh-bVJ8HGDQzJpMamA8H6CFRHsdujYwGMdJudLa9UA_xGz5D5d2xnm7S_-Ngb7K7aw54bYIWHRqUkYbOr2MjVYNnrPn4qEgDvCW3NnSdIjRi2YFDnWydQc2BYKhr4Ogvku6PHdobkeJlID3o9wwKf1gECbfOefBzT8XIiwwEgr37iCuNHOAwWS9tR1I6tT_olY_UO1CvAYUsK2G6Dm4roEgYZ_5h9U572vhFbIHzLwIYm963S2Jq6HxzA" charset="UTF-8"></script></head>
    <body>
    <div class = "wrapper">
        <div class= "form" id="reg">
            <section class="vh-30">
                <div class="container h-30">
                    <div class="row d-flex justify-content-center align-items-center h-30">
                        <div class="col-lg-8">
                            <div class="card text-black" style="border-radius: 25px;">
                                <div class="card-body p-md-1">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 order-2">
                                            <p class="text-center h3 mb-3 mx-2 mx-md-4 mt-4">Регистрация</p>
                                            <form class="mx-1 mx-md-4">
                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="email" id="email" class="form-control" name = "email"/>
                                                        <label class="form-label" for="email">Email</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="password" id="pass1" class="form-control" name = "pass1"/>
                                                        <label class="form-label" for="pass1">Пароль</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center mb-4">
                                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                    <div class="form-outline flex-fill mb-0">
                                                        <input type="password" id="pass2" class="form-control" name = "pass2"/>
                                                        <label class="form-label" for="pass2">Повторите пароль</label>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center mx-4 mb-3">
                                                    <button type="button" class="btn btn-primary" onclick="registerNewUser();">Отправить</button>
                                                    <a href = "/" type="button" class="btn btn-outline-primary me-2" style = "margin-left: 15px">Назад</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                                 class="img-fluid" alt="Sample image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    </body>
</html>