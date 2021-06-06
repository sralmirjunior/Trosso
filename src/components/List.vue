<template>
  <ion-card>
    <div class="">
      <div class="">
        {{ list.name }}
      </div>
    </div>
    <ion-list>
      <Card
        v-for="card in list.cards"
        :key="card.id"
        :card="card"
        @card-updated="$emit('card-updated')"
        @card-deleted="$emit('card-deleted')"
      ></Card>
      <CardAddEditor
        v-if="editing"
        @closed="editing = false"
        @card-added="$emit('card-added')"
        :list="list"
      ></CardAddEditor>
      <CardAddButton v-if="!editing" @click="editing = true"></CardAddButton>
    </ion-list>
  </ion-card>
</template>

<script>
import { IonCard, IonList } from "@ionic/vue";
import Card from "./Card.vue";
import CardAddButton from "./CardAddButton.vue";
import CardAddEditor from "./CardAddEditor.vue";
export default {
  props: {
    list: Object,
  },
  components: {
    IonCard,
    IonList,
    Card,
    CardAddEditor,
    CardAddButton,
  },
  data() {
    return {
      editing: false,
    };
  },
};
</script>
<style scoped>
.list {
  width: 250px;
  min-width: 250px;
}
</style>
