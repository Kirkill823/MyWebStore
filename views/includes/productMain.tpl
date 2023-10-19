
<div class="card mb-3"  style="max-width: 900px;">
    <div class="row g-0">
        <div class="col-md-6">
            <img src="img/products/{$recProduct['image']}.jpg" class="card-img"  alt="...">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h5 class="card-title">{$recProduct['name_ru']}</h5>
                <p class="card-text">{$recProduct['description']}</p>
                <p class="card-text"><small class="text-muted">{$recProduct['price']} рублей.</small></p>
                <a id="addCart_{$recProduct['id']}" {if $itemInCarts}style="display: none"{/if} onclick="addToCart({$recProduct['id']}); return false;" class="btn btn-primary order" href="#">В корзину</a>
                <a id="removeFromCart_{$recProduct['id']}" {if !$itemInCart}style="display: none"{/if} onclick="removeFromCart({$recProduct['id']}); return false" class="btn btn-primary order" href="#">Убрать из корзины</a>

            </div>
 </div>
    </div>
</div>