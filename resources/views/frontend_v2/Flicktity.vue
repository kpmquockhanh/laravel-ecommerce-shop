<template>
  <div ref="el">
    <slot />
  </div>
</template>
<script>
import { onMounted, ref } from 'vue'

import Flickity from 'flickity'
export default {
  name: 'Flickity',
  props: {
    options: Object,
  },
  setup(props, { emit }) {
    const el = ref(null)
    onMounted(() => {
      init()
    })
    let $flickity = null
    /**
     * Initialize a new flickity and emit init event.
     */
    const init = () => {
      $flickity = new Flickity(el.value, props.options)
      emit('init', $flickity)
    }

    /**
     * Return the current flickity instance to access directly
     *
     * @return {Flickity}
     */
    const flickity = () => {
      return $flickity
    }

    /**
     * Selecting Slides
     */

    /**
     * Select a slide
     *
     * @param {number} index
     * @param {boolean} isWrapped
     * @param {boolean} isInstant
     */
    const select = (index, isWrapped, isInstant) => {
      $flickity.select(index, isWrapped, isInstant)
    }

    /**
     * Change to the next slide
     *
     * @param {boolean} isWrapped
     * @param {boolean} isInstant
     */
    const next = (isWrapped, isInstant) => {
      $flickity.next(isWrapped, isInstant)
    }

    /**
     * Change to the previous slide
     *
     * @param {boolean} isWrapped
     * @param {boolean} isInstant
     */
    const previous = (isWrapped, isInstant) => {
      $flickity.previous(isWrapped, isInstant)
    }

    /**
     * Select a cell
     *
     * @param {number} value
     * @param {boolean} isWrapped
     * @param {boolean} isInstant
     */
    const selectCell = (value, isWrapped, isInstant) => {
      $flickity.selectCell(value, isWrapped, isInstant)
    }

    /**
     * Sizing and Positioning
     */

    /**
     * Trigger a resize event
     */
    const resize = () => {
      $flickity.resize()
    }

    /**
     * Trigger a reposition event
     */
    const reposition = () => {
      $flickity.reposition()
    }

    /**
     * Adding and removing cells
     */

    /**
     * Prepend elements to flickity
     *
     * @param {array|HTMLElement|NodeList} elements
     */
    const prepend = (elements) => {
      $flickity.prepend(elements)
    }

    /**
     * Append elements to flickity
     *
     * @param {array|HTMLElement|NodeList} elements
     */
    const append = (elements) => {
      $flickity.append(elements)
    }

    /**
     * Insert elements at a given index
     *
     * @param {array|HTMLElement|NodeList} elements
     * @param {number} index
     */
    const insert = (elements, index) => {
      $flickity.insert(elements, index)
    }

    /**
     * Remove elements from flickity
     *
     * @param {array|HTMLElement|NodeList} elements
     */
    const remove = (elements) => {
      $flickity.remove(elements)
    }

    /**
     * Player
     */

    /**
     * Trigger a playPlayer event
     */
    const playPlayer = () => {
      $flickity.playPlayer()
    }

    /**
     * Trigger a stopPlayer event
     */
    const stopPlayer = () => {
      $flickity.stopPlayer()
    }

    /**
     * Trigger a pausePlayer event
     */
    const pausePlayer = () => {
      $flickity.pausePlayer()
    }

    /**
     * Trigger a unpausePlayer event
     */
    const unpausePlayer = () => {
      $flickity.unpausePlayer()
    }

    /**
     * Trigger a rerender event
     */
    const rerender = () => {
      $flickity.destroy()
      this.init()
    }

    /**
     * Utilities
     */

    /**
     * Destroy the flickity instance
     */
    const destroy = () => {
      $flickity.destroy()
    }

    /**
     * Trigger a rerender event
     */
    const reloadCells = () => {
      $flickity.reloadCells()
    }

    /**
     * Get the cell elements
     *
     * @return {array}
     */
    const getCellElements = () => {
      return $flickity.getCellElements()
    }

    /**
     * Return flickity data
     *
     * @return {Flickity}
     */
    const data = () => {
      const Flickity = require('flickity')

      return Flickity.data(this.$el)
    }

    /**
     * Events
     */

    /**
     * Attach an event
     *
     * @param {string} eventName
     * @param {function} listener
     */
    const on = (eventName, listener) => {
      $flickity.on(eventName, listener)
    }

    /**
     * Remove an event
     *
     * @param {string} eventName
     * @param {function} listener
     */
    const off = (eventName, listener) => {
      $flickity.off(eventName, listener)
    }

    /**
     * Attach an event once
     *
     * @param {string} eventName
     * @param {function} listener
     */
    const once = (eventName, listener) => {
      $flickity.once(eventName, listener)
    }

    /**
     * Properties
     */

    /**
     * Return the selected element
     *
     * @return {HTMLElement}
     */
    const selectedElement = () => {
      return $flickity.selectedElement
    }

    /**
     * Return the selected elements
     *
     * @return {array}
     */
    const selectedElements = () => {
      return $flickity.selectedElements
    }

    /**
     * Return the selected index
     *
     * @return {number}
     */
    const selectedIndex = () => {
      return $flickity.selectedIndex
    }

    /**
     * Return the cells
     *
     * @return {array}
     */
    const cells = () => {
      return $flickity.cells
    }

    /**
     * Return the slides
     *
     * @return {array}
     */
    const slides = () => {
      return $flickity.slides
    }

    /**
     * Disable dragging of slider
     */
    const disableDrag = () => {
      $flickity.options.draggable = false
      $flickity.updateDraggable()
    }

    /**
     * Enable dragging of slider
     */
    const enableDrag = () => {
      $flickity.options.draggable = true
      $flickity.updateDraggable()
    }

    return {
      init,
      flickity,
      select,
      next,
      previous,
      selectCell,
      resize,
      reposition,
      prepend,
      append,
      insert,
      remove,
      playPlayer,
      stopPlayer,
      pausePlayer,
      unpausePlayer,
      rerender,
      destroy,
      reloadCells,
      getCellElements,
      data,
      on,
      off,
      once,
      selectedElement,
      selectedElements,
      selectedIndex,
      cells,
      slides,
      disableDrag,
      enableDrag,
      el,
    }
  },
}
</script>

<style src="flickity/dist/flickity.css"></style>
