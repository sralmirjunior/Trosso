<template>
  <div>
    <ion-item v-if="!editing" class="">
      <div>{{ description }}</div>
      <div class="">
        <ion-button end @click="editing = true" color="warning">
          E
        </ion-button>
        <ion-button end @click="cardDelete" color="danger">
          D
        </ion-button>
      </div>
    </ion-item>
    <div v-else>
      <textarea
        v-model="description"
        placeholder="Adicione um texto para este card"
        ref="card"
      >
      </textarea>
      <div class="">
        <ion-button @click="cardUpdate" color="success">
          Salvar
        </ion-button>
        <ion-button @click="editing = false" color="tertiary">
          Cancelar
        </ion-button>
      </div>
    </div>
  </div>
</template>
<script>
import { IonItem, IonButton } from "@ionic/vue";
import { axiosHttp } from "../tools/axios.js";
export default {
  components: { IonItem, IonButton },
  props: {
    card: Object,
  },
  data() {
    return {
      editing: false,
      description: this.card.description,
    };
  },
  methods: {
    cardDelete() {
      axiosHttp
        .get("trosso.php", {
          params: { op: "deleteCard", card_id: parseInt(this.card.id) },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.$emit("card-deleted");
          }
        });
    },
    cardUpdate() {
      let form = new FormData();
      form.append("card_id", parseInt(this.card.id));
      form.append("card_description", this.description);
      axiosHttp
        .post("trosso.php", form, {
          params: { op: "updateCard" },
        })
        .then((resp) => {
          if (resp.data.sucesso) {
            this.editing = false;
            this.$emit("card-updated");
          }
        });
    },
  },
};
</script>
