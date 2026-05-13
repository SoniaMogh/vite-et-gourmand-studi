<div id="userAccount">
  <div class="container py-5">
    <div class="row">
      <?php require "/layout/userAccountSidebar.php"; ?>
      
      <!-------------- INFORMATIONS PERSONNELLES ----------------->
      <div class="card card-corner bg-white col-4 me-5">
        <div class="text-center">
          <h2 class="text-primary p-4">Informations personnelles</h2>
        </div>
        <form
          action="<?= BASE_URL ?>/signupPost"
          method="post"
          class="form-display"
        >
          <div class="mb-3 col-12 signup-wrapper">
            <div>
              <label for="updateName">Nom</label>
              <input
                class="form-control m-0"
                type="text"
                id="updateName"
                name="updateName"
                placeholder="John"
                required
              />
            </div>
            <div>
              <label for="updateSurname">Prénom</label>
              <input
                class="form-control m-0"
                type="text"
                id="updateSurname"
                name="updateSurname"
                placeholder="Joe"
                required
              />
            </div>
          </div>
          <div class="mb-3 col-12">
            <label for="updateTel">Numéro de téléphone</label>
            <input
              class="form-control m-0"
              type="tel"
              id="updateTel"
              name="updateTel"
              placeholder="0612345678"
              pattern="0[1-9]{9}"
              required
            />
          </div>
          <div class="mb-3 col-12">
            <label for="updateEmail">Email</label>
            <input
              class="form-control m-0"
              type="email"
              id="updateEmail"
              name="updateEmail"
              placeholder="email@email.fr"
              required
            />
          </div>
          <div class="mb-3 col-12">
            <label for="updateAdress">Adresse </label>
            <input
              class="form-control m-0"
              type="text"
              id="updateAdress"
              name="updateAdress"
              placeholder="Adresse"
              required
            />
          </div>
          <div class="mb-3 col-12 signup-wrapper">
            <div>
              <label for="updateZIP">Code Postal</label>
              <input
                class="form-control m-0"
                type="text"
                id="updateZIP"
                name="updateZIP"
                placeholder="33000"
                inputmode="numeric"
                pattern="[0-9]{5}"
                required
              />
            </div>
            <div>
              <label for="updateCity">Ville</label>
              <input
                class="form-control m-0"
                type="text"
                id="updateCity"
                name="updateCity"
                placeholder="Bordeaux"
                required
              />
            </div>
          </div>
          <div class="col-12">
            <label for="updateBirthday">Date de Naissance</label>
            <input
              class="form-control"
              type="date"
              id="updateBirthday"
              name="updateBirthday"
              required
            />
          </div>

          <input
            type="submit"
            value="Sauvegarder"
            class=" btn btn-primary large-button"
          />
        </form>
      </div>
      
      <div class="col-4 p-0">
        <!-------------- DETAILS DE PAYEMENT ----------------->
        <div class="card card-corner bg-white mb-3 px-12px">
          <div class="text-center">
            <h2 class="text-primary p-4">Détails de Payement</h2>
          </div>
          <form
            action="<?= BASE_URL ?>/signupPost"
            method="post"
            class="form-display"
          >
            <div class="rounded-0 p-1 border-detail-payment d-flex flex-column w-100">
              <label 
                for="detailPaymentCardNbr" 
                class="fw-bold"
              >
                Numéro de carte
              </label>
              <input 
                type="text" 
                class="border-0 m-0"
                id="detailPaymentCardNbr" 
                name="detailPaymentCardNbr"
                placeholder="1234 1234 1234 1234"
              >
            </div>
            
            <div class="side-by-side-card-detail d-flex">
              <div class="rounded-0 p-1 border-detail-payment d-flex flex-column m-0">
                <label 
                  for="detailPaymentCardNbr" 
                  class="fw-bold "
                >
                  Expiration
                </label>
                <input 
                  type="text" 
                  class="border-0 m-0"
                  id="detailPaymentCardNbr" 
                  name="detailPaymentCardNbr"
                  placeholder="MM/YY"
                >
              </div>
              <div class="rounded-0 p-1 border-detail-payment d-flex flex-column m-0">
                <label 
                  for="detailPaymentCardNbr" 
                  class="fw-bold"
                >
                  CVC
                </label>
                <input 
                  type="password" 
                  class="border-0 m-0"
                  id="detailPaymentCardNbr" 
                  name="detailPaymentCardNbr"
                  placeholder="123"
                >
              </div>
            </div>

            <div class="rounded-0 p-1 border-detail-payment d-flex flex-column w-100">
              <label 
                for="detailPaymentCardNbr" 
                class="fw-bold"
              >
                Pays
              </label>
              <input 
                type="text" 
                class="border-0 m-0"
                id="detailPaymentCardNbr" 
                name="detailPaymentCardNbr"
                placeholder="France"
              >
            </div>

            <input
              type="submit"
              value="Sauvegarder"
              class=" btn btn-primary large-button"
            />
          </form>
        </div>

        <!-------------- CHANGEMENT DE MOT DE PASSE ----------------->
        <div class="card card-corner bg-white px-12px">
          <div class="text-center">
            <h2 class="text-primary p-4">Changer de mot de passe</h2>
          </div>

          <form
            action="<?= BASE_URL ?>/signupPost"
            method="post"
            class="form-display"
          >

            <div class="mb-3 col-12">
              <label for="updateTel">Ancien mot de passe</label>
              <input
                class="form-control m-0"
                type="tel"
                id="updateTel"
                name="updateTel"
                placeholder="0612345678"
                pattern="0[1-9]{9}"
                required
              />
            </div>
            <div class="mb-3 col-12">
              <label for="updateEmail">Nouveau mot de passe</label>
              <input
                class="form-control m-0"
                type="email"
                id="updateEmail"
                name="updateEmail"
                placeholder="email@email.fr"
                required
              />
            </div>

            <input
              type="submit"
              value="Changer"
              class=" btn btn-primary large-button"
            />
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
