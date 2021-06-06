<template>
  <ion-card>
    <ion-item v-if="!editing_list" class="" expand="block">
      <div>{{ list.name }}</div>
      <ion-buttons slot="end">
        <ion-button @click="editing_list = true" color="warning">
          E
        </ion-button>
        <ion-button @click="listDelete" color="danger">
          D
        </ion-button>
      </ion-buttons>
    </ion-item>
    <div v-else>
      <textarea
        v-model="listName"
        placeholder="Adicione um texto para este card"
      >
      </textarea>
      <div class="">
        <ion-button @click="listUpdate" color="success">
          Salvar
        </ion-button>
        <ion-button @click="editing_list = false" color="tertiary">
          Cancelar
        </ion-button>
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
import { IonCard, IonList, IonButtons, IonItem, IonButton } from "@ionic/vue";
import Card from "./Card.vue";
import CardAddButton from "./CardAddButton.vue";
import CardAddEditor from "./CardAddEditor.vue";
import { axiosHttp } from "../tools/axios.js";
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
    IonButtons,
    IonItem,
    IonButton,
  },
  data() {
    return {
      editing: false,
      editing_list: false,
      listName: this.list.name,
    };
  },
  methods: {
    listDelete() {
      axiosHttp
        .get("trosso.php", {
          params: { op: "deleteList", list_id: parseInt(this.list.id) },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.$emit("list-deleted");
          }
        });
    },
    listUpdate() {
      let form = new FormData();
      form.append("list_id", parseInt(this.list.id));
      form.append("list_name", this.listName);
      axiosHttp
        .post("trosso.php", form, {
          params: { op: "updateList" },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.editing_list = false;
            this.$emit("list-updated");
          }
        });
    },
  },
};
</script>
<style scoped>
.list {
  width: 250px;
  min-width: 250px;
}
</style>
