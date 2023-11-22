

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="p_member_form_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="p_member_form_box">
          <form method="post" action="<?php echo e(route('register')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form_title">
              <h3 class="lead">オフィス情報を登録しましょう。</h3>
              <p class="sub">オフィス機器のスムーズな取引きのために<br class="pc">オフィス情報を入力してください。</p>
            </div>
            <div class="form_input_group">
              <div class="form_input">
                <label for="nickname">ニックネーム</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>
                <?php if($errors->has('name')): ?>
                  <p class="validate"><?php echo e($errors->first('name')); ?></p>
                <?php endif; ?>
                <p class="help">※表示名です。</p>
              </div>
              <div class="form_input">
                <label for="name">氏名</label>
                <div class="input_sub">
                  <label for="name">漢字</label>
                  <input type="text" name="name_kanji" id="name_kanji" value="<?php echo e(old('name_kanji')); ?>" required autocomplete="name_kanji">
                  <?php if($errors->has('name_kanji')): ?>
                    <p class="validate"><?php echo e($errors->first('name_kanji')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="input_sub">
                  <label for="name">カナ</label>
                  <input type="text" name="name_frigana" id="name_frigana" value="<?php echo e(old('name_frigana')); ?>" required autocomplete="name_frigana">
                  <?php if($errors->has('name_frigana')): ?>
                    <p class="validate"><?php echo e($errors->first('name_frigana')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="help">※取引きが成立するまで公開されません</p>
              </div>
              <div class="form_input">
                <label for="company">会社名</label>
                <div class="input_sub">
                  <label for="name">漢字（正式名称）</label>
                  <input type="text" name="company_kanji" id="company_kanji" value="<?php echo e(old('company_kanji')); ?>" required autocomplete="company_kanji">
                  <?php if($errors->has('company_kanji')): ?>
                    <p class="validate"><?php echo e($errors->first('company_kanji')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="input_sub">
                  <label for="name">カナ</label>
                  <input type="text" name="company_frigana" id="company_frigana" value="<?php echo e(old('company_frigana')); ?>" required autocomplete="company_frigana">
                  <?php if($errors->has('company_frigana')): ?>
                    <p class="validate"><?php echo e($errors->first('company_frigana')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="help">※取引きが成立するまで公開されません</p>
              </div>
              <div class="form_input">
                <label for="address">会社住所</label>
                <div class="input_sub">
                  <label for="name">郵便番号</label>
                  <input type="text" name="company_zipcode" id="company_zipcode" class="sm" value="<?php echo e(old('company_zipcode')); ?>" required autocomplete="company_zipcode" onKeyUp="AjaxZip3.zip2addr(this,'','company_prefecture','company_address');">
                  <?php if($errors->has('company_zipcode')): ?>
                    <p class="validate"><?php echo e($errors->first('company_zipcode')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="input_sub">
                  <label for="name">都道府県</label>
                  <input type="text" name="company_prefecture" id="company_prefecture" value="<?php echo e(old('company_prefecture')); ?>" required autocomplete="company_prefecture">
                  <?php if($errors->has('company_prefecture')): ?>
                    <p class="validate"><?php echo e($errors->first('company_prefecture')); ?></p>
                  <?php endif; ?>
                </div>
                <div class="input_sub">
                  <label for="name">市区町村・番地・建物名等</label>
                  <input type="text" name="company_address" id="company_address" value="<?php echo e(old('company_address')); ?>" required autocomplete="company_address">
                  <?php if($errors->has('company_address')): ?>
                    <p class="validate"><?php echo e($errors->first('company_address')); ?></p>
                  <?php endif; ?>
                </div>
                <p class="help">※取引きやオフィス機器の設置場所の情報として利用されますが、公開はされません。</p>
              </div>
            </div>
            <div class="form_btn_row">
              <div class="btn_col">
                <a href="javascript:;" onclick="event.preventDefault(); history.back();" class="form_btn login_btn">
                  <span>戻る</span>
                </a>
              </div>
              <div class="btn_col">
                <button type="submit" class="form_btn login_btn">
                  <span>登録する</span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/register.blade.php ENDPATH**/ ?>