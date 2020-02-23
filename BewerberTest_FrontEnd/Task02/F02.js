/**
 * We working with ReactJs.
 * Here is a very common mistake hidden.
 *
 * Which line you have to change, so the function handleFormInitialize() is triggered and how.
 */

{}

  function componentDidUpdate(prevProps) {
    var { hint } = this.props;
    if (!isEqual(hint, prevProps.hint)) {
      handleFormInitialize();
    };
  }

  function handleFormInitialize() {
    var { hint, change } = this.props;
    change('id', hint.id);
    change('name', hint.name);
    change('content', hint.content);
  }

{}
