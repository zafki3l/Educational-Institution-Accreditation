<?php

use App\Services\Implementations\AuthService;
use App\Services\Implementations\CriteriaService;
use App\Services\Implementations\DepartmentService;
use App\Services\Implementations\Evidence\EvidenceDTOMapperService;
use App\Services\Implementations\Evidence\EvidenceFacadeService;
use App\Services\Implementations\Evidence\EvidenceQueryService;
use App\Services\Implementations\Evidence\Query\EvidenceQuery;
use App\Services\Implementations\FileUploadService;
use App\Services\Implementations\LockService;
use App\Services\Implementations\LogService;
use App\Services\Implementations\MilestoneService;
use App\Services\Implementations\RoleService;
use App\Services\Implementations\SessionService;
use App\Services\Implementations\StandardService;
use App\Services\Implementations\User\HandleLogUserService;
use App\Services\Implementations\User\HandleUserErrorService;
use App\Services\Implementations\User\UserCommandService;
use App\Services\Implementations\User\UserDTOMapperService;
use App\Services\Implementations\User\UserQueryService;
use App\Services\Implementations\User\UserFacadeService;
use App\Services\Interfaces\AuthServiceInterface;
use App\Services\Interfaces\CriteriaServiceInterface;
use App\Services\Interfaces\DepartmentServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceDTOMapperServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceFacadeServiceInterface;
use App\Services\Interfaces\Evidence\EvidenceQueryServiceInterface;
use App\Services\Interfaces\FileUploadServiceInterface;
use App\Services\Interfaces\LockServiceInterface;
use App\Services\Interfaces\LogServiceInterface;
use App\Services\Interfaces\MilestoneServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\SessionServiceInterface;
use App\Services\Interfaces\StandardServiceInterface;
use App\Services\Interfaces\User\HandleLogUserServiceInterface;
use App\Services\Interfaces\User\HandleUserErrorServiceInterface;
use App\Services\Interfaces\User\UserCommandServiceInterface;
use App\Services\Interfaces\User\UserDTOMapperServiceInterface;
use App\Services\Interfaces\User\UserQueryServiceInterface;
use App\Services\Interfaces\User\UserFacadeServiceInterface;

use function DI\autowire;

return [
    AuthServiceInterface::class => autowire(AuthService::class),
    UserFacadeServiceInterface::class => autowire(UserFacadeService::class),
    UserQueryServiceInterface::class => autowire(UserQueryService::class),
    UserCommandServiceInterface::class => autowire(UserCommandService::class),
    UserDTOMapperServiceInterface::class => autowire(UserDTOMapperService::class),
    HandleUserErrorServiceInterface::class => autowire(HandleUserErrorService::class),
    HandleLogUserServiceInterface::class => autowire(HandleLogUserService::class),
    DepartmentServiceInterface::class => autowire(DepartmentService::class),
    FileUploadServiceInterface::class => autowire(FileUploadService::class),
    EvidenceFacadeServiceInterface::class => autowire(EvidenceFacadeService::class),
    EvidenceQueryServiceInterface::class => autowire(EvidenceQueryService::class),
    EvidenceFacadeServiceInterface::class => autowire(EvidenceFacadeService::class),
    EvidenceDTOMapperServiceInterface::class => autowire(EvidenceDTOMapperService::class),
    CriteriaServiceInterface::class => autowire(CriteriaService::class),
    StandardServiceInterface::class => autowire(StandardService::class),
    MilestoneServiceInterface::class => autowire(MilestoneService::class),
    RoleServiceInterface::class => autowire(RoleService::class),
    SessionServiceInterface::class => autowire(SessionService::class),
    LockServiceInterface::class => autowire(LockService::class),
    LogServiceInterface::class => autowire(LogService::class)
];