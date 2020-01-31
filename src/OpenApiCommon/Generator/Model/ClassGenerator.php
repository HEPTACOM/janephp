<?php

namespace Jane\OpenApiCommon\Generator\Model;

use Jane\JsonSchema\Generator\Model\ClassGenerator as BaseClassGenerator;
use PhpParser\Node;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use PhpParser\Comment\Doc;

trait ClassGenerator
{
    use BaseClassGenerator {
        createModel as baseCreateModel;
    }

    /**
     * Return a model class.
     *
     * @param Node[] $properties
     * @param Node[] $methods
     */
    protected function createModel(string $name, array $properties, array $methods, bool $hasExtensions = false, bool $deprecated = false, ?string $extends = null): Stmt\Class_
    {
        $classExtends = null;
        if (null !== $extends) {
            $classExtends = new Name($extends);
        } elseif ($hasExtensions) {
            $classExtends = new Name('\ArrayObject');
        }

        $attributes = [];
        if ($deprecated) {
            $attributes['comments'] = [new Doc(<<<EOD
/**
 *
 * @deprecated
 */
EOD
            )];
        }

        $jsonSerialize = new Stmt\ClassMethod(new Node\Identifier('jsonSerialize'), [
            'flags' => Stmt\Class_::MODIFIER_PUBLIC,
            'returnType' => new Node\Identifier('array'),
            'stmts' => [
                new Stmt\Return_(new Node\Expr\FuncCall(new Node\Name('get_object_vars'), [
                    new Node\Arg(new Node\Expr\Variable('this')),
                ])),
            ],
        ]);

        return new Stmt\Class_(
            new Name($this->getNaming()->getClassName($name)),
            [
                'stmts' => array_merge($properties, $methods, [$jsonSerialize]),
                'extends' => $classExtends,
                'implements' => [new Node\Name('\JsonSerializable')],
            ],
            $attributes
        );
    }
}
