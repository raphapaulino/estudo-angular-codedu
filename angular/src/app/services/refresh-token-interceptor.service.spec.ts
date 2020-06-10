import { TestBed } from '@angular/core/testing';

import { RefreshTokenInterceptorService } from './refresh-token-interceptor.service';

describe('RefreshTokenInterceptorService', () => {
  let service: RefreshTokenInterceptorService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RefreshTokenInterceptorService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
