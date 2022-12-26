
[Entity](./src/Shared/Domain/Entity.php) [User](./src/Domain/User/User.php) состоит из Value Objects и имеет поведение, в результате которого изменяются его данные и генерируются [события](./src/Domain/User/Event), либо выбрасываются [исключения](./src/Domain/User/Exception).

[User](./src/Domain/User/User.php) создается из репозитория, например, [UserRedisRepository](./src/Shared/Repository/RedisRepository/UserRedisRepository.php), реализующего интерфейс [UserRepositoryInterface](./src/Contract/Repository/UserRepositoryInterface.php), туда же и сохраняется после изменений данных.

События распространяются по шине [EventBus](./src/Shared/Domain/Bus/EventBus.php) и могут быть обработаны заинтересованными [слушателями](./src/Shared/Domain/Bus/Event/EventHandlerInterface.php).

[User](./src/Domain/User/User.php) имеет права (enum [Action](./src/Domain/User/Action.php)), определяемые битовой маской [Access](./src/Domain/User/Access.php).

Работа "тонких" контроллеров заключается в:
- поднятии сущности из репозитория,
- проверке прав на текущее действие,
- вызове соответствующего поведения,
- сохранении сущности,
- отправке созданных событий в шину,
- возврате "success" или "failure".
