import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BikesRoutingModule } from './bikes-routing.module';
import { BikesComponent } from './bikes.component';
import { BikeDetailComponent } from './bike-detail/bike-detail.component';
import { BikeListComponent } from './bike-list/bike-list.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { BikeSearchPipe } from './_pipes/bike-search.pipe';

@NgModule({
  declarations: [BikesComponent, BikeDetailComponent, BikeListComponent, BikeSearchPipe],
  imports: [
    CommonModule,
    BikesRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    NgbModule
  ]
})
export class BikesModule { }
