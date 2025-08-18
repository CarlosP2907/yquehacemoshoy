@extends('company-template')

@section('title', 'Editar Lugar')

@section('page-title', 'Editar Lugar')
@section('page-subtitle', 'Actualiza la información de tu lugar')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Editar: {{ $place->name }}
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('company.places.update', $place) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <!-- Información básica -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Nombre del Lugar <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $place->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="place_type_id" class="form-label">
                                    Tipo de Lugar <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('place_type_id') is-invalid @enderror" 
                                        id="place_type_id" 
                                        name="place_type_id" 
                                        required>
                                    <option value="">Selecciona un tipo</option>
                                    @foreach($placeTypes as $type)
                                        <option value="{{ $type->id }}" 
                                                {{ old('place_type_id', $place->place_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('place_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Describe tu lugar, servicios que ofreces, horarios, etc.">{{ old('description', $place->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Estado del lugar -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-toggle-on me-2"></i>
                            Estado del Lugar
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="open" {{ old('status', $place->status) == 'open' ? 'selected' : '' }}>
                                            Abierto
                                        </option>
                                        <option value="closed" {{ old('status', $place->status) == 'closed' ? 'selected' : '' }}>
                                            Cerrado
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-geo-alt me-2"></i>
                            Ubicación
                        </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="location" class="form-label">Dirección</label>
                                    <input type="text" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           id="location" 
                                           name="location" 
                                           value="{{ old('location', $place->location) }}" 
                                           placeholder="Dirección completa del lugar">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="latitude" class="form-label">Latitud</label>
                                    <input type="number" 
                                           class="form-control @error('latitude') is-invalid @enderror" 
                                           id="latitude" 
                                           name="latitude" 
                                           value="{{ old('latitude', $place->latitude) }}" 
                                           step="any" 
                                           placeholder="Ej: -12.0464">
                                    @error('latitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="longitude" class="form-label">Longitud</label>
                                    <input type="number" 
                                           class="form-control @error('longitude') is-invalid @enderror" 
                                           id="longitude" 
                                           name="longitude" 
                                           value="{{ old('longitude', $place->longitude) }}" 
                                           step="any" 
                                           placeholder="Ej: -77.0428">
                                    @error('longitude')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contacto -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-telephone me-2"></i>
                            Información de Contacto
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" 
                                           name="phone" 
                                           value="{{ old('phone', $place->phone) }}" 
                                           placeholder="Ej: +51 123 456 789">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="website" class="form-label">Sitio Web</label>
                                    <input type="url" 
                                           class="form-control @error('website') is-invalid @enderror" 
                                           id="website" 
                                           name="website" 
                                           value="{{ old('website', $place->website) }}" 
                                           placeholder="https://tusitio.com">
                                    @error('website')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Precio -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_range" class="form-label">Rango de Precios (S/)</label>
                                <input type="number" 
                                       class="form-control @error('price_range') is-invalid @enderror" 
                                       id="price_range" 
                                       name="price_range" 
                                       value="{{ old('price_range', $place->price_range) }}" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="Precio promedio">
                                @error('price_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-image me-2"></i>
                            Imagen del Lugar
                        </h6>
                        
                        @if($place->image)
                            <div class="mb-3">
                                <label class="form-label">Imagen Actual</label>
                                <div>
                                    <img src="{{ Storage::url($place->image) }}" 
                                         alt="{{ $place->name }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                </div>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                {{ $place->image ? 'Cambiar Imagen' : 'Subir Imagen' }}
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            <div class="form-text">
                                Formatos soportados: JPG, PNG, GIF. Tamaño máximo: 2MB.
                                @if($place->image)
                                    Deja vacío para mantener la imagen actual.
                                @endif
                            </div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="imagePreview" class="d-none">
                            <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Intereses -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-heart me-2"></i>
                            Intereses Relacionados
                        </h6>
                        <div class="row">
                            @foreach($interests as $interest)
                                <div class="col-md-4 col-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="interests[]" 
                                               value="{{ $interest->id }}" 
                                               id="interest_{{ $interest->id }}"
                                               {{ in_array($interest->id, old('interests', $selectedInterests)) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="interest_{{ $interest->id }}">
                                            {{ $interest->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-text">
                            Selecciona los intereses que mejor describan tu lugar para que los usuarios puedan encontrarte fácilmente.
                        </div>
                    </div>

                    <!-- Horarios de Atención -->
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-clock me-2"></i>
                            Horarios de Atención
                        </h6>
                        <div class="row">
                            @php
                                $days = [
                                    'monday' => 'Lunes',
                                    'tuesday' => 'Martes',
                                    'wednesday' => 'Miércoles',
                                    'thursday' => 'Jueves',
                                    'friday' => 'Viernes',
                                    'saturday' => 'Sábado',
                                    'sunday' => 'Domingo'
                                ];
                            @endphp
                            @foreach($days as $dayKey => $dayName)
                                @php
                                    $schedule = $existingSchedules[$dayKey] ?? [];
                                @endphp
                                <div class="col-12 mb-3">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <strong>{{ $dayName }}</strong>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input day-checkbox" 
                                                               type="checkbox" 
                                                               id="closed_{{ $dayKey }}" 
                                                               name="schedules[{{ $dayKey }}][is_closed]" 
                                                               value="1"
                                                               data-day="{{ $dayKey }}"
                                                               {{ old("schedules.{$dayKey}.is_closed", $schedule['is_closed'] ?? false) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="closed_{{ $dayKey }}">
                                                            Cerrado
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input day-checkbox" 
                                                               type="checkbox" 
                                                               id="24h_{{ $dayKey }}" 
                                                               name="schedules[{{ $dayKey }}][is_24_hours]" 
                                                               value="1"
                                                               data-day="{{ $dayKey }}"
                                                               {{ old("schedules.{$dayKey}.is_24_hours", $schedule['is_24_hours'] ?? false) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="24h_{{ $dayKey }}">
                                                            24 horas
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="time" 
                                                           class="form-control time-input" 
                                                           name="schedules[{{ $dayKey }}][open_time]" 
                                                           id="open_{{ $dayKey }}"
                                                           data-day="{{ $dayKey }}"
                                                           value="{{ old("schedules.{$dayKey}.open_time", $schedule['open_time'] ?? '') }}"
                                                           placeholder="Apertura">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="time" 
                                                           class="form-control time-input" 
                                                           name="schedules[{{ $dayKey }}][close_time]" 
                                                           id="close_{{ $dayKey }}"
                                                           data-day="{{ $dayKey }}"
                                                           value="{{ old("schedules.{$dayKey}.close_time", $schedule['close_time'] ?? '') }}"
                                                           placeholder="Cierre">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-12">
                                                    <input type="text" 
                                                           class="form-control form-control-sm" 
                                                           name="schedules[{{ $dayKey }}][special_note]" 
                                                           value="{{ old("schedules.{$dayKey}.special_note", $schedule['special_note'] ?? '') }}"
                                                           placeholder="Nota especial (opcional)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-text">
                            Configure los horarios de atención de su lugar. Puede marcar días como cerrados o abiertos las 24 horas.
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('company.places.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Cancelar
                        </a>
                        <div>
                            <a href="{{ route('company.places.show', $place) }}" class="btn btn-outline-primary me-2">
                                <i class="bi bi-eye me-2"></i>
                                Ver Lugar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-2"></i>
                                Actualizar Lugar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Preview de imagen
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('d-none');
        }
    });

    // Geolocalización (si el navegador lo soporta)
    if (navigator.geolocation) {
        const getLocationBtn = document.createElement('button');
        getLocationBtn.type = 'button';
        getLocationBtn.className = 'btn btn-outline-primary btn-sm mt-2';
        getLocationBtn.innerHTML = '<i class="bi bi-geo-alt-fill me-1"></i> Usar mi ubicación';
        
        getLocationBtn.addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
            });
        });
        
        document.getElementById('longitude').parentNode.appendChild(getLocationBtn);
    }

    // Manejo de horarios
    const days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    
    days.forEach(day => {
        const closedCheckbox = document.getElementById(`closed_${day}`);
        const hours24Checkbox = document.getElementById(`24h_${day}`);
        const openTime = document.getElementById(`open_${day}`);
        const closeTime = document.getElementById(`close_${day}`);
        
        // Función para actualizar el estado de los inputs
        function updateInputsState() {
            if (closedCheckbox.checked) {
                hours24Checkbox.checked = false;
                hours24Checkbox.disabled = true;
                openTime.disabled = true;
                closeTime.disabled = true;
                openTime.value = '';
                closeTime.value = '';
            } else if (hours24Checkbox.checked) {
                openTime.disabled = true;
                closeTime.disabled = true;
                openTime.value = '00:00';
                closeTime.value = '23:59';
            } else {
                hours24Checkbox.disabled = false;
                openTime.disabled = false;
                closeTime.disabled = false;
            }
        }

        // Event listeners
        closedCheckbox.addEventListener('change', updateInputsState);
        hours24Checkbox.addEventListener('change', updateInputsState);
        
        // Estado inicial
        updateInputsState();
    });

    // Botón para copiar horarios de lunes a viernes
    const addCopyButtonsHTML = `
        <div class="mb-3">
            <button type="button" class="btn btn-outline-secondary btn-sm me-2" id="copyMondayToFriday">
                <i class="bi bi-files me-1"></i> Copiar Lunes a Viernes
            </button>
            <button type="button" class="btn btn-outline-secondary btn-sm me-2" id="copyToAll">
                <i class="bi bi-files me-1"></i> Copiar a Todos
            </button>
            <button type="button" class="btn btn-outline-warning btn-sm" id="clearAll">
                <i class="bi bi-trash me-1"></i> Limpiar Todo
            </button>
        </div>
    `;
    
    // Insertar botones antes del primer día
    const scheduleSection = document.querySelector('.row').children[0];
    if (scheduleSection && scheduleSection.querySelector('.card')) {
        scheduleSection.insertAdjacentHTML('beforebegin', addCopyButtonsHTML);

        // Funcionalidad de los botones
        document.getElementById('copyMondayToFriday').addEventListener('click', function() {
            const mondayData = {
                closed: document.getElementById('closed_monday').checked,
                hours24: document.getElementById('24h_monday').checked,
                openTime: document.getElementById('open_monday').value,
                closeTime: document.getElementById('close_monday').value,
                note: document.querySelector('input[name="schedules[monday][special_note]"]').value
            };

            ['tuesday', 'wednesday', 'thursday', 'friday'].forEach(day => {
                document.getElementById(`closed_${day}`).checked = mondayData.closed;
                document.getElementById(`24h_${day}`).checked = mondayData.hours24;
                document.getElementById(`open_${day}`).value = mondayData.openTime;
                document.getElementById(`close_${day}`).value = mondayData.closeTime;
                document.querySelector(`input[name="schedules[${day}][special_note]"]`).value = mondayData.note;
                
                // Disparar evento change para actualizar estado
                document.getElementById(`closed_${day}`).dispatchEvent(new Event('change'));
            });
        });

        document.getElementById('copyToAll').addEventListener('click', function() {
            const mondayData = {
                closed: document.getElementById('closed_monday').checked,
                hours24: document.getElementById('24h_monday').checked,
                openTime: document.getElementById('open_monday').value,
                closeTime: document.getElementById('close_monday').value,
                note: document.querySelector('input[name="schedules[monday][special_note]"]').value
            };

            days.slice(1).forEach(day => { // Excluir lunes
                document.getElementById(`closed_${day}`).checked = mondayData.closed;
                document.getElementById(`24h_${day}`).checked = mondayData.hours24;
                document.getElementById(`open_${day}`).value = mondayData.openTime;
                document.getElementById(`close_${day}`).value = mondayData.closeTime;
                document.querySelector(`input[name="schedules[${day}][special_note]"]`).value = mondayData.note;
                
                // Disparar evento change para actualizar estado
                document.getElementById(`closed_${day}`).dispatchEvent(new Event('change'));
            });
        });

        document.getElementById('clearAll').addEventListener('click', function() {
            if (confirm('¿Está seguro de que desea limpiar todos los horarios?')) {
                days.forEach(day => {
                    document.getElementById(`closed_${day}`).checked = false;
                    document.getElementById(`24h_${day}`).checked = false;
                    document.getElementById(`open_${day}`).value = '';
                    document.getElementById(`close_${day}`).value = '';
                    document.querySelector(`input[name="schedules[${day}][special_note]"]`).value = '';
                    
                    // Disparar evento change para actualizar estado
                    document.getElementById(`closed_${day}`).dispatchEvent(new Event('change'));
                });
            }
        });
    }
});
</script>
@endpush
