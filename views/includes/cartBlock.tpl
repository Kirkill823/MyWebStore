{if !(isset($arrUser))}
    <h8>* Для оформления заказа пройдите регистрацию или авторизуйтесь</h8>
{/if}
{if !$recProducts}
    <h8>Вы еще ничего не добавили в Корзину</h8>
{else}
    <form action = "/?controller=cart&action=order" method = "POST">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                {foreach $recProducts as $item}
                    <div class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2">
                                    <img src="img/products/{$item['image']}.jpg" class="img-fluid rounded-3" alt="{$item['name_ru']}">
                                </div>
                                <a href = "/?controller=product&id={$item['id']}/" class="col-md-4 col-lg-4 col-xl-4 nav-link active" style="color: black">{$item['name_ru']}</a>
                                <div class="col-md-2 d-flex">
                                    <input name="itemCnt_{$item['id']}" id="itemCnt_{$item['id']}" type="text" value="1" onchange="conversPrice({$item['id']}, {$item['price']})" class="form-control" aria-describedby="basic-addon1">
                                </div>
                                <div class="col-md-2 offset-lg-1">
                                    <h9 id="itemRealPrice_{$item['id']}" class="mb-0">{$item['price']} руб.</h9>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a id="removeFromCart_{$item['id']}" href="#" onclick="removeFromCartTrash({$item['id']}); return false;" class="text-danger">
                                        <i class="fas">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                            </svg>
                                        </i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
                <ul class="nav nav-pills order">
                    <li class="nav-item">
                        <button href="con" class="btn btn-primary btn-sm" type="submit">Оформить заказ</button>
                    </li>
                </ul>
            </div>
        </div>
    </form>
{/if}