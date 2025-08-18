@extends('admin-template')

@section('title', 'Panel de Administración - Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('page-title', 'Dashboard de Administración')
@section('page-subtitle', 'Vista general del sistema y métricas principales')

@section('page-actions')
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-outline-warning">
            <i class="bi bi-download me-2"></i>
            Exportar Datos
        </button>
        <button type="button" class="btn btn-warning">
            <i class="bi bi-plus-circle me-2"></i>
            Nuevo Reporte
        </button>
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Tarjetas de estadísticas principales -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-circle me-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-0 text-muted">Total Usuarios</h6>
                            <h3 class="card-title mb-0">1,247</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up me-1"></i>
                                +12% vs mes anterior
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-success bg-opacity-10 text-success rounded-circle me-3">
                            <i class="bi bi-building"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-0 text-muted">Empresas Activas</h6>
                            <h3 class="card-title mb-0">189</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up me-1"></i>
                                +8% vs mes anterior
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning rounded-circle me-3">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-0 text-muted">Eventos Este Mes</h6>
                            <h3 class="card-title mb-0">2,451</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up me-1"></i>
                                +24% vs mes anterior
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card stat-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon bg-info bg-opacity-10 text-info rounded-circle me-3">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div>
                            <h6 class="card-subtitle mb-0 text-muted">Ingresos Mensuales</h6>
                            <h3 class="card-title mb-0">$45,678</h3>
                            <small class="text-success">
                                <i class="bi bi-arrow-up me-1"></i>
                                +18% vs mes anterior
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Gráfico de actividad -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">Actividad del Sistema</h5>
                        <div class="btn-group btn-group-sm" role="group">
                            <input type="radio" class="btn-check" name="chartPeriod" id="day" checked>
                            <label class="btn btn-outline-secondary" for="day">Día</label>
                            
                            <input type="radio" class="btn-check" name="chartPeriod" id="week">
                            <label class="btn btn-outline-secondary" for="week">Semana</label>
                            
                            <input type="radio" class="btn-check" name="chartPeriod" id="month">
                            <label class="btn btn-outline-secondary" for="month">Mes</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="height: 300px;">
                        <!-- Aquí iría el gráfico -->
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light rounded">
                            <div class="text-center text-muted">
                                <i class="bi bi-bar-chart display-4 mb-3"></i>
                                <p>Gráfico de actividad</p>
                                <small>Integración con Chart.js pendiente</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Actividad reciente -->
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">Actividad Reciente</h5>
                </div>
                <div class="card-body p-0">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon bg-success bg-opacity-10 text-success">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-text mb-1">Nuevo usuario registrado</p>
                                <small class="text-muted">Juan Pérez - hace 5 min</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-warning bg-opacity-10 text-warning">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-text mb-1">Nueva empresa registrada</p>
                                <small class="text-muted">TechCorp S.A. - hace 15 min</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-info bg-opacity-10 text-info">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-text mb-1">Evento publicado</p>
                                <small class="text-muted">Concierto de Jazz - hace 1h</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-flag"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-text mb-1">Reporte recibido</p>
                                <small class="text-muted">Contenido inapropiado - hace 2h</small>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <div class="activity-content">
                                <p class="activity-text mb-1">Suscripción renovada</p>
                                <small class="text-muted">Plan Premium - hace 3h</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0">
                    <a href="#" class="btn btn-outline-primary btn-sm w-100">
                        Ver todo el historial
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas y notificaciones del sistema -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">Alertas del Sistema</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <div>
                            <strong>Uso de almacenamiento alto</strong>
                            <p class="mb-0">El servidor está utilizando el 87% de su capacidad de almacenamiento.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        <div>
                            <strong>Mantenimiento programado</strong>
                            <p class="mb-0">Actualizaciones del sistema el domingo 20 de agosto a las 2:00 AM.</p>
                        </div>
                    </div>
                    
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <div>
                            <strong>Backup completado</strong>
                            <p class="mb-0">Respaldo automático realizado exitosamente a las 3:00 AM.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0">Acciones Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="#" class="quick-action-card">
                                <div class="quick-action-icon bg-primary bg-opacity-10 text-primary">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <span>Crear Usuario</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-card">
                                <div class="quick-action-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-building-add"></i>
                                </div>
                                <span>Nueva Empresa</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-card">
                                <div class="quick-action-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <span>Ver Reportes</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="quick-action-card">
                                <div class="quick-action-icon bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-gear"></i>
                                </div>
                                <span>Configuración</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
.stat-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}

.stat-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.activity-list {
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    padding: 15px 20px;
    border-bottom: 1px solid #f0f0f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 15px;
    flex-shrink: 0;
}

.activity-content {
    flex: 1;
}

.activity-text {
    font-size: 0.9rem;
    font-weight: 500;
}

.quick-action-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    text-decoration: none;
    color: inherit;
    transition: all 0.2s ease;
}

.quick-action-card:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    color: inherit;
    text-decoration: none;
}

.quick-action-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-bottom: 10px;
    font-size: 1.5rem;
}

.quick-action-card span {
    font-size: 0.875rem;
    font-weight: 500;
    text-align: center;
}

.chart-container {
    position: relative;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aquí puedes agregar la lógica para los gráficos
    console.log('Admin Dashboard loaded');
    
    // Simular actualización de datos cada 30 segundos
    setInterval(function() {
        // Aquí actualizarías las estadísticas en tiempo real
        console.log('Updating dashboard data...');
    }, 30000);
});
</script>
@endsection
