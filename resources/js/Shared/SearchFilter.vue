<template>
  <div class="flex items-center relative">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <i class="pi pi-search"></i>
      </div>
    <input type="text" class="w-50 border-gray-300 rounded-full pl-10" autocomplete="off" name="search"
    :placeholder="'Search...'"  :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
  </div>
</template>

<script>
export default {
props:{
modelValue:String,
placeholder:String,
maxWidth:{
    type:Number,
    default:300
},
},
emits:['update:modelValue']
}

</script>

<style>

</style>
