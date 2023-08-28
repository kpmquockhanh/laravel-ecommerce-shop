<template>
  <div class="dropdown">
    <button class="btn short-by dropdown-toggle" type="button" data-toggle="dropdown" @click="onToggleDropdown">
      {{ label }}
      <span class="caret"></span>
    </button>
    <ul :class="['dropdown-menu', {'d-block': isOpen}]">
      <li v-for="item in data">
        <a href="#" @click.prevent="onSelectItem(item)">{{ item.label }}</a>
      </li>
    </ul>
  </div>
</template>
<script>
import {ref} from "vue";

export default {
  name: 'Dropdown',
  props: {
    data: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      required: true,
    }
  },
  setup(props, {emit}) {
    const isOpen = ref(false)
    const onToggleDropdown = () => {
      isOpen.value = !isOpen.value
    }
    const onSelectItem = (item) => {
        emit('change', item)
        isOpen.value = false
    }
    return {
      onToggleDropdown,
      isOpen,
        onSelectItem
    }
  }
}
</script>
