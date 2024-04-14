
<template>
    <div class="modal" v-if="showModal">
        <div class="modal-content">
            <p>You have pending loans to pay. Do you want to pay them off before creating a new loan?</p>
            <ul>
                <li v-for="loan in pendingLoans" :key="loan.id">
                    {{ loan.amount }} - {{ loan.status }}
                </li>
            </ul>
            <button @click="confirmLoan">Yes</button>
            <button @click="cancelLoan">No</button>
        </div>
    </div>
</template>
<script setup>
import {ref} from 'vue'

const   showModal = ref(true)
const props = defineProps({
    pendingLoans: {
        type: Array,
        required: true
    }
})



// function  confirmLoan() {
//     this.$inertia.post('/process-loan', {
//         confirmed: true,
//         user_id: props.pendingLoans[0].borrower_id,
//         loan_amount: 1000
//     });
//     this.showModal = false;
// }
//
// function cancelLoan() {
//     this.$inertia.post('/process-loan', {
//         confirmed: false,
//         user_id: this.pendingLoans[0].user_id, // Assuming all pending loans belong to the same user
//         loan_amount: 1000 // Adjust the loan amount accordingly
//     });
//     this.showModal = false;
// }
</script>

<style scoped>

</style>
