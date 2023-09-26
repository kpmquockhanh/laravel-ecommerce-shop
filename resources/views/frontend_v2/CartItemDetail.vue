<template>
  <tr class="cart_item">
    <td class="product-thumbnail">
      <a href="#">
        <img src="img/shop/shop_item_3.jpg" alt="">
      </a>
    </td>
    <td class="product-name">
      <a href="#">Fashion Shorts</a>
      <ul>
        <li>Size: XL</li>
        <li>Color: White</li>
      </ul>
    </td>
    <td class="product-price">
      <span class="amount">$1250.00</span>
    </td>
    <td class="product-quantity">
      <div class="quantity buttons_added">
        <input type="number" step="1" min="0" value="1" title="Qty" class="input-text qty text">
        <div class="quantity-adjust">
          <a href="#" class="plus">
            <i class="fa fa-angle-up"></i>
          </a>
          <a href="#" class="minus">
            <i class="fa fa-angle-down"></i>
          </a>
        </div>
      </div>
    </td>
    <td class="product-subtotal">
      <span class="amount">$1250.00</span>
    </td>
    <td class="product-remove">
      <a href="#" class="remove" title="Remove this item">
        <i class="ui-close"></i>
      </a>
    </td>
  </tr>
</template>
<script>
export default {
  name: 'CartItemDetail'
}
</script>