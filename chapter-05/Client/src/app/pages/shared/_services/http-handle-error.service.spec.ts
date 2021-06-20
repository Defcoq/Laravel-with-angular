import { TestBed } from '@angular/core/testing';

import { HttpErrorHandler } from './http-handle-error.service';

describe('HttpHandleErrorService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: HttpErrorHandler = TestBed.get(HttpErrorHandler);
    expect(service).toBeTruthy();
  });
});
