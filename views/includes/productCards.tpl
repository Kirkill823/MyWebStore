{foreach $recProducts as $prod}
    <div class="card" style="width: 11rem;">
        <img src="img/products/{$prod['image']}.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h9 class="card-title"><b>{$prod['name_ru']}</b></h9>
            <p class="card-price">{$prod['price']}</p>
            <a href="/?controller=product&id={$prod['id']}/" class="card-link">В корзину</a>
        </div>
    </div>
{/foreach}