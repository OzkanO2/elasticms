<?php

declare(strict_types=1);

namespace EMS\CoreBundle\DataTable\Type\Revision;

use EMS\CoreBundle\Core\DataTable\Type\AbstractEntityTableType;
use EMS\CoreBundle\Core\Revision\RemovedRevisionsService;
use EMS\CoreBundle\Entity\ContentType;
use EMS\CoreBundle\Form\Data\Condition\InMyCircles;
use EMS\CoreBundle\Form\Data\DatetimeTableColumn;
use EMS\CoreBundle\Form\Data\EntityTable;
use EMS\CoreBundle\Form\Data\UserTableColumn;
use EMS\CoreBundle\Roles;
use EMS\CoreBundle\Routes;
use EMS\CoreBundle\Service\ContentTypeService;
use EMS\CoreBundle\Service\UserService;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemovedRevisionsDataTableType extends AbstractEntityTableType
{
    public function __construct(
        RemovedRevisionsService $removedRevisions,
        private readonly ContentTypeService $contentTypeService,
        private readonly UserService $userService
    ) {
        parent::__construct($removedRevisions);
    }

    public function build(EntityTable $table): void
    {
        /** @var ContentType $contentType */
        $contentType = $table->getContext();

        $table->setLabelAttribute('label');
        $table->setDefaultOrder('modified', 'desc');
        $table->addColumn('revision.removed-revisions.column.label', 'label')->setOrderField('labelField');
        $lockBy = new UserTableColumn('revision.removed-revisions.column.deleted-by', 'deletedBy');
        $table->setDefaultOrder('modified', 'desc');
        $table->addColumnDefinition($lockBy);
        $table->addColumnDefinition(new DatetimeTableColumn('revision.draft-in-progress.column.modified', 'draftSaveDate'));

        $inMyCircles = new InMyCircles($this->userService);
        $table->addDynamicItemPostAction(Routes::PUT_BACK_REMOVED_REVISION, 'revision.removed-revisions.column.put-back', 'pencil', 'revision.removed-revisions.column.confirm-put-back-removed-revision', [
            'contentType' => 'contentType.id',
            'ouuid' => 'ouuid',
        ])->addCondition($inMyCircles)->setButtonType('primary');

        $table->addDynamicItemPostAction(Routes::DISCARD_REMOVED_REVISION, 'revision.removed-revisions.column.discard-removed-revision', 'trash', 'revision.removed-revisions.column.confirm-discard-removed-revision', [
            'contentType' => 'contentType.id',
            'ouuid' => 'ouuid',
        ])->addCondition($inMyCircles)->setButtonType('outline-danger');

        if (null !== $contentType) {
            $table->addTableAction(RemovedRevisionsService::DISCARD_SELECTED_REMOVED_REVISION, 'fa fa-trash', 'revision.removed-revisions.action.discard-selected-removed-revisions', 'revision.removed-revisions.action.discard-selected-confirm')
                ->setCssClass('btn btn-outline-danger');
        }
    }

    public function getContext(array $options): ContentType
    {
        return $this->contentTypeService->giveByName($options['content_type_name']);
    }

    public function getRoles(): array
    {
        return [Roles::ROLE_USER];
    }

    public function configureOptions(OptionsResolver $optionsResolver): void
    {
        $optionsResolver->setRequired(['content_type_name']);
    }
}
