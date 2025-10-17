<?php

namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Box;

/**
 * 水平盒子容器
 */
class LibuiHBox extends Container
{
    public function __construct() {
        parent::__construct();
        $this->handle = $this->createHandle();
        // 确保初始padding设置生效
        $this->applyPadding();
    }

    protected function createHandle(): CData {
        return Box::newHorizontalBox();
    }

    protected function applyPadding(): void {
        Box::setPadded($this->handle, $this->padded);
    }

    public function append($child, bool $stretchy = false): self {
        // 检查child是否为LibuiComponent实例
        if ($child instanceof LibuiComponent) {
            Box::append($this->handle, $child->getHandle(), $stretchy);
            $this->addChild($child);
        } else {
            // 假设child是FFI\CData对象
            Box::append($this->handle, $child, $stretchy);
        }
        return $this;
    }
}
