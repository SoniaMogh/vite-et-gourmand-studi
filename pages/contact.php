<div id="contact-part">
  <div class="container py-5">
    <div class="row card py-5 mx-5 mx-md-6 card-corner">
      <div class="col-12 text-center">
        <img
          src="<?= BASE_URL ?>/assets/pictures/logo-primary.png"
          alt="logo-v-et-g"
          class="form-logo-size"
        />
        <h1 class="text-primary">Contactez-nous</h1>
      </div>
      <form action="<?= BASE_URL ?>/messageSent" method="post" class="form-display">
        <div class="col-10">
          <label for="reason-contact">Raison de la prise de contact</label>
          <input
            class="w-100 form-control"
            type="text"
            id="reason-contact"
            name="reason-contact"
            placeholder="Ex: Menu version végétarienne"
            required
          />
        </div>
        <div class="col-10">
          <label for="description-contact">Description</label>
          <textarea
            class="w-100 form-control"
            id="description-contact"
            name="description-contact"
            rows="3"
            placeholder="Décrivez votre demande..."
            required
          ></textarea>
        </div>
        <div class="col-10">
          <label for="email-contact">Email</label>
          <input
            class="w-100 form-control"
            type="email"
            id="email-contact"
            name="email-contact"
            placeholder="mail@hotmail.fr"
            required
          />
        </div>
        <input type="submit" value="Envoyer" class="btn btn-primary">
      </form>
    </div>
  </div>
</div>
