<?php

declare(strict_types=1);

namespace EMS\CoreBundle\Core\ContentType\FieldType;

use Doctrine\Common\Collections\ArrayCollection;
use EMS\CoreBundle\Entity\FieldType;

/**
 * @implements \IteratorAggregate<FieldTypeTreeItem>
 */
class FieldTypeTreeItem implements \IteratorAggregate
{
    private FieldTypeTreeItemCollection $children;
    private ?FieldTypeTreeItem $parent = null;
    private string $name;

    /**
     * @param ArrayCollection<int, FieldType> $fieldTypes
     */
    public function __construct(
        private readonly FieldType $fieldType,
        ArrayCollection $fieldTypes
    ) {
        $this->name = $this->fieldType->getName();
        $children = [];
        $childFieldTypes = $fieldTypes->filter(fn (FieldType $f) => $f->getParent()?->getId() === $fieldType->getId());

        foreach ($childFieldTypes as $childFieldType) {
            $child = new FieldTypeTreeItem($childFieldType, $fieldTypes);
            $child->setParent($this);
            $children[$child->fieldType->getOrderKey()] = $child;
        }

        \ksort($children);
        $this->children = new FieldTypeTreeItemCollection($children);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function addChild(FieldTypeTreeItem $child): self
    {
        $this->children->set($child->fieldType->getOrderKey(), $child);

        return $this;
    }

    public function getChildren(): FieldTypeTreeItemCollection
    {
        return $this->children;
    }

    public function getChildrenRecursive(): FieldTypeTreeItemCollection
    {
        return new FieldTypeTreeItemCollection($this->toArray());
    }

    public function getFieldType(): FieldType
    {
        return $this->fieldType;
    }

    /**
     * @return \Traversable<FieldTypeTreeItem>
     */
    public function getIterator(): \Traversable
    {
        return new \RecursiveArrayIterator($this->toArray());
    }

    public function getName(): string
    {
        return $this->name;
    }

//    usage in specific-permissions-field.html.twig
    public function getDisplayOptionsLabel(): ?string
    {
        $fieldType = $this->getFieldType();
        $options = $fieldType->getOptions();

        // Vérifiez si l'option 'displayOptions' est définie et si elle contient un label
        if (isset($options['displayOptions']['label'])) {
            return $options['displayOptions']['label'];
        }

        // Retourne null si l'option 'displayOptions' ou le label n'est pas défini
        return null;
    }

    /**
     * @return FieldTypeTreeItem[]
     */
    public function getPath(): array
    {
        $path = [$this];

        if ($this->parent) {
            $path = [...$this->parent->getPath(), ...$path];
        }

        return $path;
    }

    /**
     * @return FieldTypeTreeItem[]
     */
    public function toArray(): array
    {
        $data = [$this];

        foreach ($this->children as $child) {
            $data = [...$data, ...$child->toArray()];
        }

        return $data;
    }
    public function setParent(?FieldTypeTreeItem $parent): void
    {
        $this->parent = $parent;
    }
    public function getParent(): ?FieldTypeTreeItem
    {
        return $this->parent;
    }
}