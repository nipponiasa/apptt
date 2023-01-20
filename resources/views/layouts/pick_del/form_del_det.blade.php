        <!-- Line chart -->
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title">
                      <i class="fas fa-fw fa-user"></i>
                    Dealer
                    </h3>
                      <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas "></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                            </button>
                    </div>
              </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-9 mb-2">
                    <div class="form-group">
                          <label for="dealer">Dealer</label>
                          <select id="dealer" name="dealer" onchange="get_dealers_locations()" class="form-control shadow-lg bg-secondary" aria-describedby="dealerHelp" aria-label="Default select example">
                            <option selected>Selecteer een dealer..</option>
                            @foreach($uii as $dealer)
                                  {
                                    <option value="{{$dealer['id']}}">{{$dealer['display_name']}}</option>
                                  }
                            @endforeach
                          </select>
                          <small id="dealerHelp" class="form-text text-muted">{{--Choose a dealer to autofill the phone and mail fields.--}} Kies een dealer om de telefoon- en email-velden automatisch in te vullen.</small>
                      </div>
                    </div>
                </div>




                <div class="row">
                  <div class="col-md-9 mb-2">
                    <div class="form-group">
                          <label for="dealerloc">Dealer locatie {{--Dealer Location--}}</label>
                          <select id="dealerloc" name="dealerloc" onchange="get_dealer_add()" class="form-control shadow-lg bg-secondary" aria-describedby="dealerHelp" aria-label="Default select example">
                            <option selected>Selecteer een locatie..</option>
                          </select>
                          <small id="dealerlocHelp" class="form-text text-muted">{{--Choose a dealer location to autofill the address.--}} Kies een dealer locatie om het adres automatisch in te vullen.</small>
                      </div>
                    </div>
                </div>



                        <div class="row">
                                    <div class="col-md-9 mb-2">
                                        <div class="form-group">
                                              <label for="address">Adres {{--Address--}}</label>
                                                  <textarea id="address" name="address" style="background-color:#ffa50085;" class="form-control"  aria-describedby="addressHelp" rows="3"></textarea>
                                              <small id="addressHelp" class="form-text text-muted">Dit is het adres zoals geïmporteerd uit Odoo, dit kan indien nodig worden gewijzigd. {{--This is the address as it has been imported in Odoo, this can be changed if needed.--}}</small>
                                        </div>
                                    </div>
                        </div>

                        <div class="row">
                                    <div class="col-md-6 mb-3">        
                                              <div class="form-group">
                                                    <label for="phone">Telefoon {{--Phone--}}</label>
                                                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phoneHelp" placeholder="Telefoon">
                                                    <small id="phoneHelp" class="form-text text-muted">Dit is het telefoonnummer zoals geïmporteerd uit Odoo, dit kan indien nodig worden gewijzigd. {{--This is the phone as it has been imported in Odoo, this can be changed if needed.--}}</small>
                                              </div>
                                    </div>


                                    <div class="col-md-6 mb-3">        
                                              <div class="form-group">
                                                    <label for="maila">Emailadres {{--Mail Address--}}</label>
                                                    <input type="text" class="form-control" name="maila" id="maila" aria-describedby="mailaHelp" placeholder="Emailadres">
                                                    <small id="mailaHelp" class="form-text text-muted">Dit is het email-adres zoals geïmporteerd uit Odoo, dit kan indien nodig worden gewijzigd. {{--This is the mail as it has been imported in Odoo, this can be changed if needed.--}}</small>
                                              </div>
                                    </div>
                   </div>



             
                  <!-- /.card-body-->
      </div>
        <!-- /.card -->
  
      </div>
      <!-- /.col -->
