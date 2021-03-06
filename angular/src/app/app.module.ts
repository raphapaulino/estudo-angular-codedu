import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { LoginComponent } from './components/pages/login/login.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { CategoryListComponent } from './components/pages/category/category-list/category-list.component';
import { AlertErrorComponent } from './components/bootstrap/alert-error/alert-error.component';
import { ModalComponent } from './components/bootstrap/modal/modal.component';
import { CategoryNewModalComponent } from './components/pages/category/category-new-modal/category-new-modal.component';
import { CategoryEditModalComponent } from './components/pages/category/category-edit-modal/category-edit-modal.component';
import { CategoryDeleteModalComponent } from './components/pages/category/category-delete-modal/category-delete-modal.component';
import { NotifyMessageService } from './services/notify-message.service';
import { NgxPaginationModule } from 'ngx-pagination';
import { ProductListComponent } from './components/pages/product/product-list/product-list.component';
import { ProductNewModalComponent } from './components/pages/product/product-new-modal/product-new-modal.component';
import { ProductEditModalComponent } from './components/pages/product/product-edit-modal/product-edit-modal.component';
import { ProductDeleteModalComponent } from './components/pages/product/product-delete-modal/product-delete-modal.component';
import { NumberFormatBrPipe } from './pipes/number-format-br.pipe';
import { ProductCategoryListComponent } from './components/pages/product-category/product-category-list/product-category-list.component';
import { ProductCategoryNewComponent } from './components/pages/product-category/product-category-new/product-category-new.component';
import { JwtModule, JWT_OPTIONS } from '@auth0/angular-jwt';
import { AuthService } from './services/auth.service';
import { NavbarComponent } from './components/bootstrap/navbar/navbar.component';
import { RefreshTokenInterceptorService } from './services/refresh-token-interceptor.service';
import { SortColumnComponent } from './components/common/sort-column/sort-column.component';
import { CategorySearchFormComponent } from './components/pages/category/category-search-form/category-search-form.component';
import { CategoryFormComponent } from './components/pages/category/category-form/category-form.component';
import { FieldErrorComponent } from './components/bootstrap/field-error/field-error.component';
import { IsInvalidDirective } from './directives/is-invalid.directive';
import { ListErrorComponent } from './components/bootstrap/list-error/list-error.component';
import { CardErrorComponent } from './components/bootstrap/card-error/card-error.component';
import { environment } from 'src/environments/environment';


export function jwtFactory(authService: AuthService) {
  return {
    whitelistedDomains: [
      // new RegExp('localhost:8000/*'),
      new RegExp(`${environment.api.host}/*`)
    ],
    tokenGetter: () => {
      return authService.getToken();
    }
  }
}

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    AlertErrorComponent,
    ModalComponent,
    CategoryListComponent,
    CategoryNewModalComponent,
    CategoryEditModalComponent,
    CategoryDeleteModalComponent,
    ProductListComponent,
    ProductNewModalComponent,
    ProductEditModalComponent,
    ProductDeleteModalComponent,
    NumberFormatBrPipe,
    ProductCategoryListComponent,
    ProductCategoryNewComponent,
    NavbarComponent,
    SortColumnComponent,
    CategorySearchFormComponent,
    CategoryFormComponent,
    FieldErrorComponent,
    IsInvalidDirective,
    ListErrorComponent,
    CardErrorComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    AppRoutingModule,
    NgxPaginationModule,
    JwtModule.forRoot({
      jwtOptionsProvider: {
        provide: JWT_OPTIONS,
        useFactory: jwtFactory,
        deps: [AuthService]
      }
    })
  ],
  providers: [
    NotifyMessageService,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: RefreshTokenInterceptorService,
      multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
