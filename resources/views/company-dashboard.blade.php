@extends('company-template')

@section('title', 'Dashboard Empresarial')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('page-title', 'Dashboard Empresarial')
@section('page-subtitle', 'Resumen de tu empresa y métricas principales')

@section('page-actions')
    <div class="btn-group">
        <button type="button" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Nuevo Servicio
        </button>
        <button type="button" class="btn btn-outline-primary">
            <i class="bi bi-calendar-plus me-1"></i>
            Crear Evento
        </button>
    </div>
@endsection

@section('content')
<div class="row">
    <!-- Métricas principales -->
    <div class="col-12 mb-4">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-people-fill text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 text-muted small">Usuarios Alcanzados</h6>
                                <h3 class="mb-0 fw-bold">2,458</h3>
                                <span class="text-success small">
                                    <i class="bi bi-arrow-up me-1"></i>+12%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-star-fill text-success fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 text-muted small">Reseñas Promedio</h6>
                                <h3 class="mb-0 fw-bold">4.8</h3>
                                <span class="text-success small">
                                    <i class="bi bi-arrow-up me-1"></i>+0.2
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-calendar-event text-warning fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 text-muted small">Eventos Activos</h6>
                                <h3 class="mb-0 fw-bold">8</h3>
                                <span class="text-muted small">
                                    Esta semana
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                    <i class="bi bi-graph-up text-info fs-4"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 text-muted small">Crecimiento</h6>
                                <h3 class="mb-0 fw-bold">+15%</h3>
                                <span class="text-success small">
                                    <i class="bi bi-arrow-up me-1"></i>Este mes
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Contenido principal -->
    <div class="col-lg-8">
        <!-- Actividad reciente -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-semibold">Actividad Reciente</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Ver todo</a>
                </div>
            </div>
            <div class="card-body">
                <div class="activity-timeline">
                    <div class="activity-item">
                        <div class="activity-icon bg-primary">
                            <i class="bi bi-plus-circle text-white"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Nuevo evento creado</h6>
                            <p class="text-muted mb-1">Workshop de cocina italiana</p>
                            <small class="text-muted">Hace 2 horas</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-success">
                            <i class="bi bi-star text-white"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Nueva reseña recibida</h6>
                            <p class="text-muted mb-1">5 estrellas en "Clase de yoga"</p>
                            <small class="text-muted">Hace 4 horas</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-info">
                            <i class="bi bi-people text-white"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Nuevos seguidores</h6>
                            <p class="text-muted mb-1">8 usuarios siguieron tu empresa</p>
                            <small class="text-muted">Ayer</small>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon bg-warning">
                            <i class="bi bi-calendar text-white"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">Evento próximo</h6>
                            <p class="text-muted mb-1">Recordatorio: "Taller de fotografía" mañana</p>
                            <small class="text-muted">Hace 2 días</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Servicios populares -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-semibold">Servicios Más Populares</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary">Gestionar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="service-item p-3 border rounded-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://via.placeholder.com/40x40" alt="Servicio" class="rounded me-3">
                                <div>
                                    <h6 class="mb-0">Clases de Yoga</h6>
                                    <small class="text-muted">Bienestar y salud</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">4.9 ★</span>
                                <small class="text-muted">156 participantes</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="service-item p-3 border rounded-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://via.placeholder.com/40x40" alt="Servicio" class="rounded me-3">
                                <div>
                                    <h6 class="mb-0">Taller de Cocina</h6>
                                    <small class="text-muted">Gastronomía</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">4.8 ★</span>
                                <small class="text-muted">89 participantes</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="service-item p-3 border rounded-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://via.placeholder.com/40x40" alt="Servicio" class="rounded me-3">
                                <div>
                                    <h6 class="mb-0">Fotografía</h6>
                                    <small class="text-muted">Arte y creatividad</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">4.7 ★</span>
                                <small class="text-muted">72 participantes</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="service-item p-3 border rounded-3">
                            <div class="d-flex align-items-center mb-2">
                                <img src="https://via.placeholder.com/40x40" alt="Servicio" class="rounded me-3">
                                <div>
                                    <h6 class="mb-0">Excursiones</h6>
                                    <small class="text-muted">Turismo</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">4.9 ★</span>
                                <small class="text-muted">134 participantes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar derecho -->
    <div class="col-lg-4">
        <!-- Estado de la empresa -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold">Estado de la Empresa</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="company-avatar bg-primary rounded-3 p-3 me-3">
                        <i class="bi bi-building text-white fs-4"></i>
                    </div>
                    <div>
                        <h6 class="mb-0">{{ auth()->user()->name ?? 'Tu Empresa' }}</h6>
                        <small class="text-muted">
                            @if(auth()->user() && auth()->user()->verified)
                                <i class="bi bi-check-circle-fill text-success me-1"></i>Verificada
                            @else
                                <i class="bi bi-clock text-warning me-1"></i>Pendiente verificación
                            @endif
                        </small>
                    </div>
                </div>
                
                <div class="progress mb-2" style="height: 8px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                </div>
                <small class="text-muted">Perfil completado al 75%</small>
                
                <hr class="my-3">
                
                <div class="d-grid">
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i>
                        Completar Perfil
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Mensajes recientes -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-semibold">Mensajes</h5>
                    <span class="badge bg-primary">3</span>
                </div>
            </div>
            <div class="card-body">
                <div class="message-item d-flex align-items-center mb-3">
                    <div class="message-avatar bg-success rounded-circle me-3">A</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small">Ana García</h6>
                        <p class="mb-0 small text-muted">Consulta sobre clase de yoga...</p>
                        <small class="text-muted">Hace 1 hora</small>
                    </div>
                </div>
                
                <div class="message-item d-flex align-items-center mb-3">
                    <div class="message-avatar bg-info rounded-circle me-3">C</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small">Carlos Ruiz</h6>
                        <p class="mb-0 small text-muted">¿Disponible para evento privado?</p>
                        <small class="text-muted">Hace 2 horas</small>
                    </div>
                </div>
                
                <div class="message-item d-flex align-items-center">
                    <div class="message-avatar bg-warning rounded-circle me-3">M</div>
                    <div class="flex-grow-1">
                        <h6 class="mb-0 small">María López</h6>
                        <p class="mb-0 small text-muted">Gracias por el taller!</p>
                        <small class="text-muted">Ayer</small>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <div class="d-grid">
                    <a href="#" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-chat-dots me-1"></i>
                        Ver todos los mensajes
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Próximos eventos -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="mb-0 fw-semibold">Próximos Eventos</h5>
            </div>
            <div class="card-body">
                <div class="event-item d-flex mb-3">
                    <div class="event-date bg-primary text-white rounded text-center p-2 me-3">
                        <div class="small">AGO</div>
                        <div class="fw-bold">18</div>
                    </div>
                    <div>
                        <h6 class="mb-0 small">Taller de Fotografía</h6>
                        <small class="text-muted">10:00 AM - 2:00 PM</small>
                        <div><span class="badge bg-success small">12 inscritos</span></div>
                    </div>
                </div>
                
                <div class="event-item d-flex mb-3">
                    <div class="event-date bg-success text-white rounded text-center p-2 me-3">
                        <div class="small">AGO</div>
                        <div class="fw-bold">20</div>
                    </div>
                    <div>
                        <h6 class="mb-0 small">Clase de Yoga</h6>
                        <small class="text-muted">7:00 AM - 8:30 AM</small>
                        <div><span class="badge bg-success small">8 inscritos</span></div>
                    </div>
                </div>
                
                <div class="event-item d-flex">
                    <div class="event-date bg-info text-white rounded text-center p-2 me-3">
                        <div class="small">AGO</div>
                        <div class="fw-bold">22</div>
                    </div>
                    <div>
                        <h6 class="mb-0 small">Workshop de Cocina</h6>
                        <small class="text-muted">6:00 PM - 9:00 PM</small>
                        <div><span class="badge bg-warning small">5 inscritos</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.activity-timeline {
    position: relative;
}

.activity-item {
    display: flex;
    align-items-flex-start;
    margin-bottom: 1.5rem;
    position: relative;
}

.activity-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    width: 2px;
    height: calc(100% + 0.5rem);
    background: #e9ecef;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}

.activity-content {
    flex-grow: 1;
}

.message-avatar, .company-avatar {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 14px;
}

.message-avatar {
    width: 35px;
    height: 35px;
    font-size: 12px;
}

.event-date {
    width: 50px;
    height: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.service-item {
    transition: all 0.2s ease;
}

.service-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}
</style>
@endpush
