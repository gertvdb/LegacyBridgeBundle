<?php
// ecs.php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnusedFunctionParameterSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\DocCommentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Classes\DuplicateClassNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\EmptyStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\ForLoopShouldBeWhileLoopSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\ForLoopWithTestFunctionCallSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\JumbledIncrementerSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnconditionalIfStatementSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UnnecessaryFinalModifierSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\UselessOverridingMethodSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\TodoSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Commenting\FixmeSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures\InlineControlStructureSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\ByteOrderMarkSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\DisallowMultipleStatementsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\MultipleStatementAlignmentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Formatting\SpaceAfterCastSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\CallTimePassByReferenceSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Functions\OpeningFunctionBraceBsdAllmanSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\ConstructorNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\NamingConventions\UpperCaseConstantNameSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DeprecatedFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\DisallowShortOpenTagSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\NoSilencedErrorsSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\UpperCaseConstantSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Strings\UnnecessaryStringConcatSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\DisallowTabIndentSniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\WhiteSpace\ScopeIndentSniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\PHP\EvalObjectFactorySniff;
use PHP_CodeSniffer\Standards\MySource\Sniffs\PHP\GetRequestDataSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Classes\ClassDeclarationSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\ControlStructures\ControlSignatureSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\ControlStructures\MultiLineConditionSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Files\IncludingFileSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Functions\FunctionCallSignatureSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Functions\FunctionDeclarationSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\Functions\ValidDefaultValueSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\WhiteSpace\ObjectOperatorIndentSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\WhiteSpace\ScopeClosingBraceSniff;
use PHP_CodeSniffer\Standards\PEAR\Sniffs\WhiteSpace\ScopeIndentSniff as ScopeIndentSniffPear;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Classes\ClassDeclarationSniff as ClassDeclarationSniffPsr2;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Classes\PropertyDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures\ElseIfDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\ControlStructures\SwitchDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Files\EndFileNewlineSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Methods\MethodDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Namespaces\NamespaceDeclarationSniff;
use PHP_CodeSniffer\Standards\PSR2\Sniffs\Namespaces\UseDeclarationSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\CommentedOutCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowComparisonAssignmentSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowMultipleAssignmentsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DisallowSizeFunctionsInLoopsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\DiscouragedFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\EmbeddedPhpSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\EvalSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\GlobalKeywordSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\HeredocSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\InnerFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\LowercasePHPFunctionsSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\NonExecutableCodeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MemberVarScopeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MethodScopeSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\StaticThisUsageSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\CastSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ControlStructureSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\FunctionClosingBraceSpaceSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\FunctionOpeningBraceSpaceSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\FunctionSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LanguageConstructSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\LogicalOperatorSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\MemberVarSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ObjectOperatorSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\PropertyLabelSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ScopeClosingBraceSniff as ScopeClosingBraceSniffSquiz;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\ScopeKeywordSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SemicolonSpacingSniff;
use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\SuperfluousWhitespaceSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

/**
 * Configure ecs config.
 * @param ContainerConfigurator $containerConfigurator
 */
return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();
    $parameters = $containerConfigurator->parameters();
    $parameters->set('cache_directory', __DIR__ . '/.cache/ecs');

    $parameters->set(
        Option::PATHS, [
            __DIR__ . '/src',
            __DIR__ . '/ecs.php'
        ]
    );

    $parameters->set(
        Option::SKIP, [
            ClassDeclarationSniffPsr2::class . '.CloseBraceAfterBody' => NULL,
            UnusedFunctionParameterSniff::class . '.FoundInExtendedClassAfterLastUsed' => NULL,
            DocCommentSniff::class . '.MissingShort' => NULL,
        ]
    );

    $parameters->set(Option::LINE_ENDING, "\n");

    $services->set(DocCommentSniff::class);
    $services->set(DuplicateClassNameSniff::class);
    $services->set(EmptyStatementSniff::class);
    $services->set(ForLoopShouldBeWhileLoopSniff::class);
    $services->set(ForLoopWithTestFunctionCallSniff::class);
    $services->set(JumbledIncrementerSniff::class);
    $services->set(UnconditionalIfStatementSniff::class);
    $services->set(UnnecessaryFinalModifierSniff::class);
    $services->set(UnusedFunctionParameterSniff::class);
    $services->set(UselessOverridingMethodSniff::class);
    $services->set(TodoSniff::class);
    $services->set(FixmeSniff::class);
    $services->set(InlineControlStructureSniff::class);
    $services->set(ByteOrderMarkSniff::class);

    $services->set(DisallowMultipleStatementsSniff::class);
    $services->set(MultipleStatementAlignmentSniff::class);
    $services->set(SpaceAfterCastSniff::class);
    $services->set(CallTimePassByReferenceSniff::class);
    $services->set(OpeningFunctionBraceBsdAllmanSniff::class);
    $services->set(CyclomaticComplexitySniff::class)->property('complexity', 5)->property('absoluteComplexity', 10);

    $services->set(NestingLevelSniff::class);
    $services->set(ConstructorNameSniff::class);
    $services->set(UpperCaseConstantNameSniff::class);
    $services->set(DeprecatedFunctionsSniff::class);
    $services->set(DisallowShortOpenTagSniff::class);
    $services->set(ForbiddenFunctionsSniff::class);
    $services->set(NoSilencedErrorsSniff::class);
    $services->set(UpperCaseConstantSniff::class);
    $services->set(UnnecessaryStringConcatSniff::class);
    $services->set(DisallowTabIndentSniff::class);
    $services->set(ScopeIndentSniff::class);
    $services->set(EvalObjectFactorySniff::class);
    $services->set(GetRequestDataSniff::class);
    $services->set(ClassDeclarationSniff::class);
    $services->set(ControlSignatureSniff::class);
    $services->set(MultiLineConditionSniff::class);
    $services->set(IncludingFileSniff::class);
    $services->set(FunctionCallSignatureSniff::class);
    $services->set(FunctionDeclarationSniff::class);
    $services->set(ValidDefaultValueSniff::class);
    $services->set(ObjectOperatorIndentSniff::class);
    $services->set(ScopeClosingBraceSniff::class);
    $services->set(ScopeIndentSniffPear::class);
    $services->set(ClassDeclarationSniffPsr2::class);
    $services->set(PropertyDeclarationSniff::class);
    $services->set(ElseIfDeclarationSniff::class);
    $services->set(SwitchDeclarationSniff::class);
    $services->set(EndFileNewlineSniff::class);
    $services->set(MethodDeclarationSniff::class);
    $services->set(NamespaceDeclarationSniff::class);
    $services->set(UseDeclarationSniff::class);
    $services->set(CommentedOutCodeSniff::class);
    $services->set(DisallowComparisonAssignmentSniff::class);
    $services->set(DisallowMultipleAssignmentsSniff::class);
    $services->set(DisallowSizeFunctionsInLoopsSniff::class);
    $services->set(DiscouragedFunctionsSniff::class)->property('error', TRUE);

    $services->set(EmbeddedPhpSniff::class);
    $services->set(EvalSniff::class);
    $services->set(GlobalKeywordSniff::class);
    $services->set(HeredocSniff::class);
    $services->set(InnerFunctionsSniff::class);
    $services->set(LowercasePHPFunctionsSniff::class);
    $services->set(NonExecutableCodeSniff::class);
    $services->set(MemberVarScopeSniff::class);
    $services->set(MethodScopeSniff::class);
    $services->set(StaticThisUsageSniff::class);
    $services->set(CastSpacingSniff::class);
    $services->set(ControlStructureSpacingSniff::class);
    $services->set(FunctionClosingBraceSpaceSniff::class);
    $services->set(FunctionOpeningBraceSpaceSniff::class);
    $services->set(FunctionSpacingSniff::class)->property('spacing', 1);
    $services->set(LanguageConstructSpacingSniff::class);
    $services->set(LogicalOperatorSpacingSniff::class);
    $services->set(MemberVarSpacingSniff::class);
    $services->set(ObjectOperatorSpacingSniff::class);
    $services->set(OperatorSpacingSniff::class);
    $services->set(PropertyLabelSpacingSniff::class);
    $services->set(ScopeClosingBraceSniffSquiz::class);
    $services->set(ScopeKeywordSpacingSniff::class);
    $services->set(SemicolonSpacingSniff::class);
    $services->set(SuperfluousWhitespaceSniff::class);

};
