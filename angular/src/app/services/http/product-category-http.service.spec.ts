import { TestBed } from '@angular/core/testing';

import { ProductCategoryHttpService } from './product-category-http.service';

describe('ProductCategoryHttpService', () => {
  let service: ProductCategoryHttpService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(ProductCategoryHttpService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
