<?php

namespace Kingbes\Libui\SDK;


use FFI\CData;
use Kingbes\Libui\Box;

class LibuiVBox extends Container
{

    public function __construct() {
        parent::__construct();
        $this->handle = $this->createHandle();
        // 确保初始padding设置生效
        $this->applyPadding();
    }

    protected function createHandle(): CData {
        return Box::newVerticalBox();
    }

    protected function applyPadding(): void {
        Box::setPadded($this->handle, $this->padded);
    }

    public function append($child, bool $stretchy = false): self {
        // 检查child是否为LibuiComponent实例
        if ($child instanceof LibuiComponent) {
            // 检查组件是否已经有父级，如果有则先移除
            if ($child->getParent() !== null) {
                $child->getParent()->removeChild($child);
            }
            Box::append($this->handle, $child->getHandle(), $stretchy);
            $this->addChild($child);
        } elseif ($child instanceof \FFI\CData) {
            // child是FFI\CData对象
            Box::append($this->handle, $child, $stretchy);
        } else {
            throw new \InvalidArgumentException("Child must be either LibuiComponent or FFI\CData");
        }
        return $this;
    }
    
    public function addChild($child): self {
        // 检查child是否为LibuiComponent实例
        if ($child instanceof LibuiComponent) {
            Box::append($this->handle, $child->getHandle(), false);
            parent::addChild($child);
        } else {
            // 假设child是FFI\CData对象
            Box::append($this->handle, $child, false);
        }
        return $this;
    }
}
