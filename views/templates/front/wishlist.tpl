{extends file='page.tpl'}

{block name='page_content_container'}
    <div class="container">
        <div class="card">
            <div class="card-block">
                <h1>YOUR WISHLIST</h1>
            </div>
            <hr class="separator">
            <div class="cart-overview">
                {if $wishlist}
                    <ul class="cart-items">
                        {foreach from=$wishlist item=product}
                            <li class="cart-item">
                                <div class="row ml-1">
                                    <div class="col-md-3">
                                        <img src="{$link->getImageLink($product.link_rewrite, $product.images, 'small_default')}"
                                             alt="">
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <a class="label"
                                               href="{$link->getProductLink($product.id_product, $product.link_rewrite)|escape:'html':'UTF-8'}">{$product.name}</a>
                                        </div>
                                        <div class="current-price">
                                            {*<span class="price">&euro;{round($product.price,2)}</span>*}
                                            {*<p class="price">{Tools::displayPrice($product.price + ((Tax::getProductTaxRate($product.id_product)*$product.price)/100))}</p>*}
                                            {if ($product.reduction !== null)}
                                                <p class="price">
                                                    <span class="discountedPrice">{Tools::displayPrice($product.price + ((Tax::getProductTaxRate($product.id_product)*$product.price)/100))}</span>
                                                    <span class="discount">{$product.reduction * 100}%</span>
                                                </p>
                                                <p class="priceAfterDiscount">
                                                    <span>{Tools::displayPrice((($product.price)-($product.price*$product.reduction))*(((Tax::getProductTaxRate($product.id_product))/100)+1))}</span>
                                                </p>
                                            {else}
                                                <p class="priceFull">
                                                    <span>{Tools::displayPrice($product.price + ((Tax::getProductTaxRate($product.id_product)*$product.price)/100))}</span>
                                                </p>
                                            {/if}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="description">
                                            {strip_tags($product.description_short)}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <form action="" method="post">
                                            <button type="submit" name="submit_deleteFromWishlist" value="{$product.id}"
                                                    class="btn btn-danger"><i class="material-icons float-xs-left">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        {/foreach}
                    </ul>
                    <div class="row">
                        <div class="col-md-3 float-lg-right">
                            <form action="">
                                <div>
                                    <form action="" method="post">
                                        <button type="submit" name="submit_deleteAllWishlist" class=" btn btn-success mb-1">
                                            CLEAR WISHLIST
                                        </button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                {else}
                    <span class="no-items">There are no items in your wishlist</span>
                {/if}
            </div>
        </div>
    </div>
{/block}
