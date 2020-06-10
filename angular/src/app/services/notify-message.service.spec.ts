import { TestBed } from '@angular/core/testing';

import { NotifyMessageService } from './notify-message.service';

describe('NotifyMessageService', () => {
  let service: NotifyMessageService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(NotifyMessageService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
