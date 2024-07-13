<template>
    <section class="section-wrap pt-80 pb-40 catalogue">
        <div class="container relative">
            <ShopFilter />
            <div class="row">
                <LeftSidebar />
                <div class="col-md-9 catalogue-col right mb-50">
                    <div :class="['shop-catalogue', `${layout}-view`]">
                        <div class="row items-grid">
                            <div
                                class="product"
                                :class="[
                                  `product-${layout}`,
                                  { 'col-md-4 col-xs-6': layout === 'grid' },
                                ]"
                                v-for="product in products"
                                :key="product.id"
                            >
                                <ProductItem :type="layout" :product="product" />
                            </div>
                        </div>
                    </div>
                    <PaginationV2
                        :total="total"
                        :per-page="perPage"
                        v-model:current-page="currentPage"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import ShopFilter from "./components/ShopFilter.vue";
import { onMounted } from "vue";
import { useLayout } from "../../js/composables/layout";
import LeftSidebar from "./components/LeftSidebar.vue";
import PaginationV2 from "./components/PaginationV2.vue";
import ProductItem from "./components/ProductItem.vue";
import { useProduct } from "../../js/composables/product";
import { useCategory } from "../../js/composables/category";

export default {
    name: "CataloguePage",
    components: { ProductItem, PaginationV2, LeftSidebar, ShopFilter },
    props: {},
    setup() {
        const {
            products,
            productMeta,
            fetchProducts,
            isLoadingProducts,
            currentPage,
            perPage,
            total,
            onChangeSort,
        } = useProduct();
        const {
            fetchCategories,
            categories,
            countCategories,
            currentCategory,
            isLoadingCategory,
            onClickCategory
        } = useCategory();

        onMounted(() => {
            fetchProducts("w5");
            fetchCategories();
        });

        const { layout } = useLayout();
        return {
            products,
            categories,
            currentCategory,
            onClickCategory,
            isLoadingProducts,
            isLoadingCategory,
            onChangeSort,
            productMeta,
            currentPage,
            total,
            perPage,
            layout,
            countCategories
        };
    }
};
</script>
